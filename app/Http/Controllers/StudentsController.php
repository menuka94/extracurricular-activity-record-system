<?php

namespace App\Http\Controllers;

use App\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Auth;

class StudentsController extends Controller
{
    public function getAllStudents()
    {
        $students = DB::select('select * from students');
        return view('students.all_students', [
            'students' => $students
        ]);
    }

    public function newStudent()
    {
        return view('students.register');
    }


    public function getDashboard()
    {
        $student = Student::findByUserId(Auth::User()->id);
        $sports = Student::getSportsOfStudent($student->index_no);
        $organizations = Student::getOrganizationsOfStudent($student->index_no);
        $achievements = Student::getAchievementsOfStudent($student->index_no);
        $competitions = Student::getCompetitionsOfStudent($student->index_no);
        return view('students.dashboard', [
            'student' => $student,
            'sports' => $sports,
            'organizations' => $organizations,
            'achievements' => $achievements,
            'competitions' => $competitions
        ]);
    }

    public function addNewStudent(Request $request)
    {
        $this->validate($request, [
            'index_no' => 'required|alpha_num|size:7',
            'email' => 'required|email',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required',
            'batch' => 'required|integer|min:2010',
            'dob' => 'required',
            'password' => 'required|same:password_confirmation'
        ]);

        $index_no = $request['index_no'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $dob = $request['dob'];
        $gender = $request['gender'];
        $batch = $request['batch'];
        $pwd = Crypt::encrypt($request['password']);
        $email = $request['email'];
        $role = 'student';

        // to check whether index number is in the format 140183H
        $index_no_substring1 = substr($index_no, 0, 6);
        $index_no_substring2 = substr($index_no, -1);



        $condition1=is_numeric($index_no_substring1);
        $condition2=ctype_alpha ( $index_no_substring2 );

        /////////////////  is to be added later, because of ease
//        DB::statement("Call InsertStudent(?,?,?,?,?,?,?,?)",[$index_no,$email,$first_name,$last_name,$gender,$batch,$dob,$pwd]);

        if(!$condition1 or !$condition2){
            return view('students.register', ['customMessage' => 'index number you entered is not valid']);
        }


        $checkIndexNoQuery = DB::select('select * from students where index_no = ?', [$index_no]);
        if ($checkIndexNoQuery != null) {
            return view('students.register', ['customMessage' => 'the index_no you entered is already exists, check and enter your details again']);
        }


        $checkEmailQuery = DB::select('select id from users where email = ?', [$email]);
        if ($checkEmailQuery != null) {
            return view('students.register', ['customMessage' => 'email is already acquired, try again']);
        }


        DB::statement("Call InsertStudent(?,?,?,?,?,?,?,?)",[$index_no,$email,$first_name,$last_name,$gender,$batch,$dob,$pwd]);

//        $line1 = "insert into users (email,password,role) values (?,?,?)";
//        DB::statement($line1, [$email, $pwd, $role]);
//
//        //to fetch id, because there is no other way to get that foreign key
//        $id1 = DB::select('select id from users where email = ?', [$email]);
//        $id = null;
//        foreach ($id1 as $user) {
//            $id = $user->id;
//        }
//
//
//        // to update student table
//
//        $line2 = "insert into students (index_no, first_name, last_name,gender,user_id,dob,batch) values (?,?,?,?,?,?,?)";
//        DB::statement($line2, [$index_no, $first_name, $last_name, $gender, $id, $dob, $batch]);
//
       return view('user_login', ['customMessage' => 'registered successfully. now log in to proceed']);
  }
}
