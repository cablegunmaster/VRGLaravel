<?php

namespace App\Http\Controllers;

use App\PointsOfInterest;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use stdClass;

class AllDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        //UserToken -> User -> Incident

        /**
         * Get information based on the Token.
         * For incident Table and users Table.
         */
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

        /**
         * Load the current task which hassnt ended instead of all tasks.
         * With the current Task_type involved.
         */
        $task = Task::select('task.id as task_id',
            'task_type.name as type',
            'task.data as data',
            'task.title as title',
            'task.description as remarks')
        ->leftJoin('task_type', 'task.id', '=', 'task_type.id')
        ->where('task.team_id', $table[0]->team_id)
        ->where('task.incident_id', $table[0]->incident_id)
        ->where('task.end_date', '0000-00-00 00:00:00')
        ->orderBy('task.id','asc')
        ->first();

        //TODO implement the chat here from one token? or all?
        $chat = null;

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
            ->groupBy('location.task_id')
            ->orderBy('location.created_at','desc')
            ->get();

        /**
         * Get all the roadblocks from incident X.
         * Needs TYPE to identify which is a roadblock.
         */
        $roadblocks = PointsOfInterest::where('incident_id', '=', $table[0]->incident_id)->get();

        $locations_JSON =  json_decode(View('api.GEOJsonLocation')->with('locations', $locations),true);
        $roadblock_JSON = json_decode(View('api.GEOJsonRoadblock')->with('roadblocks', $roadblocks),true );

        $geo = new stdClass(); //All GeoJSON obects go in this one! (empty array sort like laravel class).
        $geo->roadblock = $roadblock_JSON;
        $geo->locations = $locations_JSON;

        $table[0]->task = $task;
        $table[0]->chat = $chat;
        $table[0]->geo = $geo;

        return $table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
