<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\CompetitionActivity;
use App\Organization;
use App\Sport;
use App\Student;
use App\Supervisor;
use App\User;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function getIndex()
    {
        $all_sports = Sport::getAll();
        $all_organizations = Organization::getAll();
        $all_competitions = CompetitionActivity::getAll();
        $all_achievements = Achievement::getAll();
        return view('admin.index', [
            'sports' => $all_sports,
            'organizations' => $all_organizations,
            'competitions' => $all_competitions,
            'achievements' => $all_achievements
        ]);
    }


    public function getAllStudents()
    {
        $students = Student::getAll();

        return view('admin.all_students', [
            'students' => $students
        ]);
    }

    public function getAllSupervisors()
    {
        $supervisors = Supervisor::getAll();
        return view('admin.all_supervisors', [
            'supervisors' => $supervisors
        ]);
    }

    // actually a toggles the flag
    public function flagUser($user_id){
        User::toggleFlag($user_id);
        return redirect()->back();
    }

    // for a single student
    public function getStudentProfile($index_no)
    {
        $student = Student::findByIndexNo($index_no);
        $sports = Student::getSportsOfStudent($index_no);
        $organizations = Student::getOrganizationsOfStudent($index_no);
        $achievements = Student::getAchievementsOfStudent($index_no);
        $competitions = Student::getCompetitionsOfStudent($index_no);

        return view('admin.student_profile',[
            'student' => $student,
            'sports' => $sports,
            'organizations' => $organizations,
            'achievements' => $achievements,
            'competitions' => $competitions
        ]);
    }

    // for a single sport
    public function getSportProfile($sport_id)
    {
        $sport = Sport::findById($sport_id);
        $students = Sport::getStudentsBySport($sport_id);
        return view('sports.profile', [
            'sport' => $sport,
            'students' => $students
        ]);
    }

    // for a single organization
    public function getOrganizationProfile($organization_id)
    {
        $organization = Organization::findById($organization_id);
        $students = Organization::getStudentsByOrganization($organization_id);
        return view('organizations.profile', [
            'organization' => $organization,
            'students' => $students
        ]);
    }
}

