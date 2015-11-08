<?php

namespace App\Http\Controllers;

use App\PointsOfInterest;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use stdClass;

class AllDataController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  String  $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $geo = new stdClass(); //All GeoJSON obects go in this one! (empty array sort like laravel class).
        $chat = null; //TODO implement.

        //UserToken -> User -> Incident
        $table = AllDataController::getUserIncident($token);
        $task = AllDataController::getTask($table[0]->team_id,$table[0]->incident_id); //team_id and incident_id required.

        $geo->locations = AllDataController::getLocation($table[0]->incident_id);
        $geo->roadblock = AllDataController::getRoadblocks($table[0]->incident_id);
        $geo->mal = AllDataController::getMal($table[0]->incident_id);

        $table[0]->task = $task;
        $table[0]->chat = $chat;
        $table[0]->geo = $geo;

        return $table;
    }

    /**
     * For incident Table and users Table.
     * @param $token String based on Token from user. remember_token.
     * @return array|static[] Table with information about incident and Users.
     */
    public static function getUserIncident($token){
        $table = DB::table('users')
            ->select('incident.information as incident_name'
                ,'users.username'
                ,'users.remember_token as token'
                ,'users.team_id'
                ,'incident.id as incident_id'
            )
            ->where('users.remember_token','=',$token)
            ->leftJoin('incident_users', 'users.id', '=', 'incident_users.user_id')
            ->leftJoin('incident', 'incident_id', '=', 'incident_users.incident_id')
            ->get();
        return $table;
    }

    /**
     * Load the current task which hassnt ended instead of all tasks.
     * With the current Task_type involved.
     * @param $team_id String
     * @param $incident_id String
     * @return array|static[] Table with information about the Task.
     */
    public static function getTask($team_id,$incident_id){
        $task = Task::select('task.id as task_id',
            'task_type.name as type',
            'task.data as data',
            'task.title as title',
            'task.description as remarks')
            ->leftJoin('task_type', 'task.id', '=', 'task_type.id')
            ->where('task.team_id', $team_id)
            ->where('task.incident_id', $incident_id)
            ->where('task.end_date', '0000-00-00 00:00:00')
            ->orderBy('task.id','asc')
            ->first();
        return $task;
    }

    /**
     * TODO check if this one misses a constriction in its query.
     */
    public static function getLocation($incident_id){
        /**
         * Get all locations from everyone.
         */
        $locations = DB::table("location")
            ->select("task.id as tasks_id",
                "location.*",
                "task.title",
                "task.description"
            )
            ->leftJoin('users','location.user_id','=', 'users.id')
            ->leftJoin('task','users.team_id','=','task.team_id')
            ->where('task.incident_id', $incident_id)
            ->groupBy('location.task_id')
            ->orderBy('location.created_at','desc')
            ->get();

        return json_decode(View('api.GEOJsonLocation')->with('locations', $locations),true);
    }

    /**
     * Get all the roadblocks from incident X.
     * Needs TYPE to identify which is a 'obstruction'
     */
    public static function getRoadblocks($incident_id){
        $roadblocks = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', $incident_id)
            ->where('poi_type.name',"=",'obstruction')
            ->get();

        $roadblock_JSON = View('api.GEOJsonRoadblock')->with('roadblocks', $roadblocks)->render();
        return json_decode(AllDataController::removeRN($roadblock_JSON),true); //remove the weird /r/n
    }

    /**
     * Get all the malls belonging to the current incident.
     */
    public static function getMal($incident_id){

        $mal = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', $incident_id)
            ->where('poi_type.name','mal','properties')
            ->get();

        $mal_JSON = View('api.GEOJSONmal')->with('mal', $mal)->render();
        return json_decode(AllDataController::removeRN($mal_JSON),true);
    }

    /**
     * @param $source STRING to remove /r/n from.
     * @return mixed String without /r/n
     */
    public static function removeRN($source){
        return  preg_replace("@[\\r|\\n|\\t]+@", "", $source); //remove the weird /r/n
    }
}
