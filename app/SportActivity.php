<?php

namespace App;

use DB;
use Exception;

class SportActivity
{
    public $activity_id;
    public $sport_id;
    public $role;
    public $sport_name;
    public $activity; // activity object

    public static function getAll()
    {
        try{
            $raw_sport_activities = DB::select('select * from sport_activities');
            if($raw_sport_activities== null || empty($raw_sport_activities)){
                return [];
            }
            $sport_activities = array();
            foreach ($raw_sport_activities as $sport_activity) {
                $a = new SportActivity();
                $a->id = $sport_activity->id;
                $a->sport_id = $sport_activity->sport_id;
                $a->role = $sport_activity->role;
                $a->sport_name = Sport::findById($a->sport_id);
                $a->activity = Activity::findById($a->activity_id);
                array_push($sport_activities, $a);
            }
            return $sport_activities;
        }catch(Exception $e){
            return [];

        }
    }

    public static function findById($activity_id)
    {
        try {
            $a = DB::select('select * from sport_activities where id=?', [$activity_id]);
            if ($a == null || empty($a)) {
                return [];
            } else {
                $a = $a[0];
                $sport_activity = new SportActivity();
                $sport_activity->activity_id = $a->id;
                $sport_activity->sport_id = $a->sport_id;
                $sport_activity->role = $a->role;
                $sport_activity->sport_name = Sport::findById($a->sport_id)->name;
                $sport_activity->activity = Activity::findById($a->id);
                return $sport_activity;
            }
        } catch (Exception $e) {
            echo "Exception: ". $e ."<br>";
            return [];
        }

    }

    public static function update(SportActivity $sport_activity)
    {
        try {
            DB::statement('update sport_activities set sport_id=?,role=? where id=?', [$sport_activity->sport_id, $sport_activity->role, $sport_activity->activity_id]);
        }catch (Exception $e){
            return false;
        }
        return true;
    }

    public static function insert(SportActivity $sport_activity)
    {
        try {
            DB::statement('insert into sport_activities (id,sport_id,role) values (?,?,?)', [$sport_activity->activity_id, $sport_activity->sport_id, $sport_activity->role]);
        }catch (Exception $e){
            return false;
        }
        return true;
    }
}
