<?php

/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 11/11/2015
 * Time: 10:12 PM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\PointsOfInterest;
use DB;
use Input;

class POIController extends Controller
{
    // this list all POIs in database with a valid JSON (Every json in the POI table is a GEOJSON anyway so
    public function getPOIs() {
        $result = array();
        $result['success'] = false;
        $result['poi'] = array();

        $POIs = PointsOfInterest::all();
        foreach ($POIs as $poi) {
            if($poi->feature != null && $this->isJson($poi->feature)) {
                $result['poi'][] = $poi->feature;   // simply add to array;p
            }
        }
        $result['success'] = true;
        return json_encode($result);
    }
    public function newPOI() {
        $result = array();
        $result['success'] = false;
        if(Input::has('data')) {
            $poi = new PointsOfInterest();
            $poi->feature = json_encode(Input::get('data'));
            $poi->save();
            $result['success'] = true;
        }
        else {
            $result['error'] = "NO_DATA";
        }
        return json_encode($result);
    }

    // http://stackoverflow.com/questions/6041741/fastest-way-to-check-if-a-string-is-json-in-php
    // Is the supplied string a valid Json Yes/No
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}