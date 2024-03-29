<?php

namespace App;

use DB;
use Exception;

class OrgActivity
{
    public $activity_id;
    public $org_id;
    public $project_name;
    public $role;
    public $org_name;
    public $activity; // activity object


    public static function getAll()
    {
        try {
            $raw_org_activities = DB::select('select * from org_activities');
            if($raw_org_activities== null || empty($raw_org_activities)){
                return [];
            }
            $org_activities = array();
            foreach ($raw_org_activities as $org_activity) {
                $a = new OrgActivity();
                $a->activity_id = $org_activity->id;
                $a->org_id = $org_activity->org_id;
                $a->project_name = $org_activity->project_name;
                $a->role = $org_activity->role;

                array_push($org_activities, $a);
            }
            return $org_activities;
        }catch (Exception $e){
            return [];
        }
    }

    public static function findById($id)
    {
        $a = DB::select('select * from org_activities where id=?', [$id])[0];
        $org_activity = new OrgActivity();
        $org_activity->activity_id = $a->id;
        $org_activity->org_id = $a->org_id;
        $org_activity->project_name = $a->project_name;
        $org_activity->role = $a->role;
        $org_activity->org_name = Organization::findById($a->org_id)->name;
        $org_activity->activity = Activity::findById($a->id);

        return $org_activity;
    }

    public static function update(OrgActivity $org_activity){
        try {
            DB::statement('update org_activities set org_id=?,project_name=?,role=? where id=?', [$org_activity->org_id, $org_activity->project_name, $org_activity->role, $org_activity->activity_id]);
        }catch (Exception $e){
            return false;
        }
        return true;
    }

    public static function insert(OrgActivity $org_activity){
        try {
            DB::statement('insert into org_activities (id,org_id,project_name,role) values (?,?,?,?)', [$org_activity->activity_id, $org_activity->org_id, $org_activity->project_name, $org_activity->role]);
        }catch (Exception $e){
            return false;
        }
        return true;
    }

}
