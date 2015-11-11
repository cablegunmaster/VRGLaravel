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
                $array = json_decode($poi->feature, true);
                $array['properties']['id'] = $poi->id;  // add internal ID to GeoJSON props
                $result['poi'][] = json_encode($array);   // simply add to array;p
            }
        }
        $result['success'] = true;
        return json_encode($result);
    }
    public function newPOI() {
        $result = array();
        $result['success'] = false;
        if(Input::has('data')) {
            // since the input is missing some properties do that magic here.
            $data = Input::get('data');
            $data['properties'] = array(
                "title"=> "Wegversperring"
            );
            $data['geometry']['coordinates'][0] = doubleval($data['geometry']['coordinates'][0]);
            $data['geometry']['coordinates'][1] = doubleval($data['geometry']['coordinates'][1]);
            $poi = new PointsOfInterest();
            $poi->feature = json_encode($data);
            $poi->save();
            $result['data'] = $data;
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