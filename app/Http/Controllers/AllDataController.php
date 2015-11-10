<?php

namespace App\Http\Controllers;

use App\Chat_Status;
use App\Location;
use App\Measurement;
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

        $table = AllDataController::getUserIncident($token);
        if(!isset($table[0])){
            return '{ "success": "error" }';
        }

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
     */
    public function store()
    {
        if (!isset($_POST['data'])) {
            $post = '
    {
          "token": "068c9087a94570e873ea3485f5f8c005",
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
                "created":"2015-10-01 12:00:01",
                "remarks": "opmerking :)",
                "echo": {
                     "echo": 2
                 },
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
         },
         {
         "type": "observation",
         "location": {
                    "lat"  : 51.3045,
                    "long" : 6.0539
                },
         "observation": "Iets van een regel tekst",
         "image": "PLOATKE"
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
                  "id": null,
                  "type":"chat",
                  "message":"Hello world",
                  "state":null
                }
        ]
    }
';
        } else {
            $post = $_POST['data'];
        }
        $post = json_decode($post, true); //make a array of POST.

        //Push chat function als ID is null.
        //$post['chat'];

        /**
         * Insert location command, with the corresponding task as well.
         */
        $table = AllDataController::getUserIncident($post['token']);
        $task = AllDataController::getTask($table->team_id, $table->incident_id);
        $table->task = $task; //task aan table zetten.
        if (!isset($post['own_location'])) {
            AllDataController::insertLocation($table, $post['own_location']); //Sets result in the table.
        }

        if (!empty($post['data'])) {
            //Post all data in the controllers.
            $post['data'] = AllDataController::InsertData($post['data'],$table);
        }

        return $post;
    }

    /**
     * Insert the location to be called.
     * @param $user
     * @param $own_location
     */
    public static function insertLocation($user, $own_location)
    {
        $location = new Location();
        $location->lat = $own_location['lat'];
        $location->lon = $own_location['long'];

        //check if the TASK has been set, needed for the ID, to prevent errors.
        if (!empty($user->task) && !empty($user->task[0]->task_id)) {
            $location->task_id = $user->task[0]->task_id;
        }

        $location->user_id = $user->user_id;
        $location->save();
    }


    public static function InsertData($data,$table){
        $count = count($data); //count only once.
        for($i = 0; $i < $count; $i++){

            switch ($data[$i]['type']) {
                case "measurement":
                    //Create new location.
                    $location = new Location();
                    $location->lat = $data[$i]['location']['lat'];
                    $location->lon = $data[$i]['location']['long'];
                    $location->task_id = $data[$i]['task_id'];
                    $location->user_id = $table->user_id;
                    $location->save();

                    //Update End time of the Task.
                    $task = Task::find($data[$i]['task_id']); //get only 1 task by id.
                    $task->end_date = $data[$i]['created']; //created seems like end_date of task.
                    $task->save();

                    //Merge Echo's and bravo's.
                    $measurement_data = array();
                    $measurement_data = array_merge($measurement_data, $data[$i]['echo']);
                    $measurement_data = array_merge($measurement_data, $data[$i]['bravos']);

                    //Create a measurement.
                    $measurement = new Measurement();
                    $measurement->message = $data[$i]['remarks'];
                    $measurement->data= json_encode($measurement_data);
                    $measurement->location_id = $location->id;
                    $measurement->save();
                    break;
                case "earthquake":
                    break;
                case "observation":
                    //Todo implement observation.
                    break;
                case "task":
                    break;
                case "chat":
                    break;
            }
        }
        return $data;
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
                ,'users.id as user_id'
                ,'users.remember_token as token'
                ,'users.team_id'
                ,'incident.id as incident_id'
            )
            ->where('users.remember_token','=',$token)
            ->leftJoin('incident_users', 'users.id', '=', 'incident_users.user_id')
            ->leftJoin('incident', 'incident.id', '=', 'incident_users.incident_id')
            ->first();
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
            ->get();
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

        $mal_JSON = View('api.GEOJSONmal')->with('mal', $mal)->render();
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
