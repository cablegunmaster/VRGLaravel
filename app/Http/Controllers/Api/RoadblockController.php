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

class RoadblockController extends Controller
{
    // TODO fix database

    public function newRoadBlock() {
        $result = array();

        $location = new Location;
        $location->lat = $_POST['lat'];
        $location->lon = $_POST['lng'];
        $location->save();

        $result['loc'] = $location->toJson();
        $result['success'] = true;
        return json_encode($result);
    }

    public function loadRoadBlock() {
        $locations = Location::all();
        return json_encode($locations);
    }

    public function deleteRoadBlock() {
        $result = array();

        $location = new Location;
        $location->lat = $_POST['lat'];
        $location->lon = $_POST['lng'];
        // delete this bs

        $result['success'] = true;
        return json_encode($result);
    }
}