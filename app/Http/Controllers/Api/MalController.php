<?php

namespace App\Http\Controllers\Api;

use App\PointsOfInterest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Location;
use App\User;
use DB;

class MalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newMal() {
        $poi = new PointsOfInterest();
        $poi->feature = json_encode($_POST['malJSON']);
        $poi->save();
    }

    public function loadMal() {
        $poi = PointsOfInterest::all()->last();
        return $poi->feature;
    }
}
