<?php

/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 10/27/2015
 * Time: 1:33 PM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Location;
use App\PointsOfInterest;
use DB;

class RoadblockController extends Controller
{
    // TODO fix database
    // TODO how to get the incidentID?
    // TODO how to get the current TASK ID?

    public function newRoadBlock() {
        $result = array();

        $poi = new PointsOfInterest();
        $poi->lat = $_POST['lat'];
        $poi->lon = $_POST['lng'];

        //TODO fix the incident ID and the TaskID. Where to get them.
        $poi->incident_id = '1';//HARDCODED incident_id replace with SESSION later.
        $poi->task_id = '1';//HARDCODED task_id replace with SESSION later.
        $poi->poi_type = '1'; //1 is obstruction.
        $poi->save();

        $result['loc'] = $poi->toJson();
        $result['success'] = true;
        return json_encode($result);
    }

    public function loadRoadBlock() {
        //HARDCODED incident_id replace with SESSION later.
        $pois = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', '1')
            ->where('poi_type.name','obstruction')
            ->get();
        //return View('api.GEOJsonRoadblock')->with('roadblocks', $roadblocks);
        //return json_decode($pois,true );
    }

    public function deleteRoadBlock() {
        $result = array();

        //$poi = DB::table('pointsofinterest')->where('lat', '=', $_POST['lat'])->where('long', '=', $_POST['lng'])->find();

        $poi = PointsOfInterest::find($_POST['id']);
        $poi->delete();

        $result['success'] = true;
        $result['roadblock'] = $poi;
        return json_encode($result);
    }

    public function index(){
        $roadblocks = PointsOfInterest::where('incident_id', '=', '1')->get(); //HARDCODED incident_id replace with SESSION later.
        return View('api.GEOJsonRoadblock')->with('roadblocks', $roadblocks);
    }
}