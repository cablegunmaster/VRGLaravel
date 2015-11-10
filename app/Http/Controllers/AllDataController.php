<?php

namespace App\Http\Controllers;

use App\Chat_Status;
use App\PointsOfInterest;
use App\Task;
use App\Chat;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use stdClass;

class AllDataController extends Controller
{
    /**
     * Display All data based on a Token.
     * @param  String  $token Token from a user from users.remember_token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $geo = new stdClass(); //All GeoJSON obects go in this one! (empty array sort like laravel class).

        //UserToken -> User -> Incident
        $table = AllDataController::getUserIncident($token);
        $task = AllDataController::getTask($table[0]->team_id, $table[0]->incident_id); //team_id and incident_id required.
        $chat = AllDataController::getChat($table[0]->incident_id, $table[0]->user_id);

        $mal = AllDataController::getMal($table[0]->incident_id);
        $location = AllDataController::getLocation($table[0]->incident_id);
        $roadblock = AllDataController::getRoadblocks($table[0]->incident_id);
        $linestring = AllDataController::getLineString($table[0]->incident_id);

        /**
         * Merge them all in 1 neat array without errors!
         */
        $geo = array();
        if (is_array($mal)) {
            $geo = array_merge_recursive($geo, $mal);
        }
        if (is_array($location)) {
            $geo = array_merge_recursive($geo, $location);
        }
        if (is_array($roadblock)) {
            $geo = array_merge_recursive($geo, $roadblock);
        }
        if (is_array($linestring)) {
            $geo = array_merge_recursive($geo, $linestring);
        }

        $geo['type'] = "FeatureCollection"; //fix the multiple definition of featurecollections.

        $table[0]->task = $task;
        $table[0]->chat = $chat;
        $table[0]->geo = $geo;

        $response = response()->json($table[0]);
        $response->header('Content-Type', 'application/json');
        $response->header('charset', 'utf-8');

        return $response;
    }


    /**
     * FAKE POST request.
     * @return string
     *
    public function store(){

        $post = '
    {
          "token": "HqCaJI9pI0",
          "own_location": {
                "lat"  : 52.3045,
                "long" : 6.0539
            },
          "data": [
          {
                "task_id": 2,
                "type": "measurement",
                "location": {
                    "lat"  : 51.3045,
                    "long" : 6.0539
                },
                "created":"HH-MM-SS",
                "remarks": "opmerking :)",
                "echo" : "?",
                "bravos":
                [
                    {
                        "bravo":11,
                        "november": 5,
                        "charlie": 8,
                        "tango":"2015-10-01 12:00:01"
                    },{
                        "bravo":11,
                        "november": 5,
                        "charlie": 8,
                        "tango":"2012-01-05 01:00:00"
                    }
                ]
          },
         {
          "type": "earthquake",
          "location": {
                    "lat"  : 51.3045,
                    "long" : 6.0539
                },
          "tango": "2012-01-05 01:00:00",
          "score_s": 1,
          "score_g": 2,
          "score_i": 3,
          "remarks_s": null,
          "remarks_g": "veel los glas",
          "remarks_i": "Wegen kapot"
         }

        ],

         "chat":
        [
                {
                  "id": null,
                  "type":"chat",
                  "message":"Hello world",
                  "state":null
                },
                {
                    "id": 1,
                    "type":"task",
                    "state":"finished"
                 },
                 {
                    "id": 2,
                    "type":"task",
                    "state":"received"
                 },
                {
                  "id": 128,
                  "type":"chat",
                  "state":"received"
                }
        ]
    }
';
        $post = json_decode($post,true);
        dd($post['chat']);
        return $post;
    }*/

    /**
     * For incident Table and users Table.
     * @param $token String based on Token from user. remember_token.
     * @return array|static[] Table with information about incident and Users.
     */
    public static function getUserIncident($token){
        $table = DB::table('users')
            ->select('incident.information as incident_name'
                ,'users.username'
                ,'users.id as user_id'
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
            ->whereNull('task.end_date')
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

        return json_decode(View('api.GeoJSONLocation')->with('locations', $locations),true);
    }

    /**
     * Get all the roadblocks from incident X.
     * Needs TYPE to identify which is a 'obstruction'
     * @param $incident_id
     * @return mixed
     */
    public static function getRoadblocks($incident_id){
        $roadblocks = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', $incident_id)
            ->where('poi_type.name',"=",'obstruction')
            ->get();

        $roadblock_JSON = View('api.GeoJSONRoadblock')->with('roadblocks', $roadblocks)->render();
        return json_decode(AllDataController::removeRN($roadblock_JSON),true); //remove the  /r/n
    }

    /**
     * Get all the malls belonging to the current incident.
     * @param $incident_id
     * @return mixed
     */
    public static function getMal($incident_id){
        $mal = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', $incident_id)
            ->where('poi_type.name',"=",'mal')
            ->get();

        $mal_JSON = View('api.GEOJSONMal')->with('mal', $mal)->render();
        return  json_decode(AllDataController::removeRN($mal_JSON),true); //remove the /r/n
    }

    /**
     * @param $incident_id
     */
    public static function getChat($incident_id, $user_id){
        $chat_messages = Chat::select(
            "chat.created_at",
            "chat.message as message",
            "chat.img_path",
            "chat_status.receive_date",
            "chat_status.read_date",
            "users.username",
            "chat.id"
            )
            ->where("incident_id","=", $incident_id)
            ->leftjoin("chat_status","chat.id","=","chat_status.chat_id")
            ->leftjoin("users","chat.user_id","=","users.id")
            ->whereNull('chat_status.receive_date')
            ->get();

        foreach($chat_messages as $chat){
            //$chat_status = new Chat_Status();
            Chat_Status::firstOrCreate([
                'chat_id'  => $chat->id,
                'user_id' => $user_id
            ]);
            //$chat_status->chat_id = $chat->id;
            //$chat_status->user_id = $user_id;
            //$chat_status->save();
        }
        return $chat_messages;
    }

    public static function getLineString($incident_id){
        $LineString = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', $incident_id)
            ->where('poi_type.name',"=",'waypoints')
            ->get();

        $LineString = View('api.GeoJSONLineString')->with('linestring', $LineString)->render();

        return  json_decode(AllDataController::removeRN($LineString),true); //remove the /r/n
    }

    /**
     * @param $source STRING to remove /r/n from.
     * @return mixed String without /r/n
     */
    public static function removeRN($source){
        return  preg_replace("@[\\r|\\n|\\t]+@", "", $source); //remove the  /r/n
    }
}
