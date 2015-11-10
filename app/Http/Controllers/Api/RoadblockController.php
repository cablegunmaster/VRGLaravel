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
use App\Poi_Type;
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
        $poi->feature = $_POST['lat'].",".$_POST['lng'];

        //TODO fix the incident ID and the TaskID. Where to get them.
        $poi->incident_id = '1';//HARDCODED incident_id replace with SESSION later.
        $poi->task_id = '1';//HARDCODED task_id replace with SESSION later.

        $type = Poi_Type::select('id')->where('name','=','obstruction')->first(); //get id from obstruction.
        $poi->poi_type = $type->id; //ID for obstruction.
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
        return View('api.GEOJsonRoadblock')->with('roadblocks', $pois);
    }

    public function deleteRoadBlock() {
        $result = array();
        $poi = PointsOfInterest::find($_POST['id']);
        $poi->delete();

        $result['success'] = true;
        $result['roadblock'] = $poi;
        return json_encode($result);
    }

    public function index(){
        $roadblocks = PointsOfInterest::leftjoin('poi_type','pointsofinterest.poi_type','=','poi_type.id')
            ->where('pointsofinterest.incident_id', '=', '1')
            ->where('poi_type.name','obstruction')
            ->get(); //HARDCODED incident_id replace with SESSION later.
        return View('api.GEOJsonRoadblock')->with('roadblocks', $roadblocks);
    }
}