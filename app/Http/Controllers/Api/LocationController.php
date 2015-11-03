<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Location;
use DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO only grab the last task thats ACTIVE!
        $locations = DB::table("location")
            ->leftJoin('task', 'task.id', '=', 'location.task_id')
            ->orderBy('location.created_at', 'desc')
            ->groupBy('user_id')
            ->get();

        //$locations = Location::orderBy('created_at', 'asc')->groupBy('user_id')->get();
        return View('api.GEOJsonLocation')->with('locations', $locations);
    }

    public function bullshitMal()
    {
        return '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"title":"Mal Groen-3","description":"","stroke":"#a3e46b","stroke-width":4,"stroke-opacity":1,"fill":"#a3e46b","fill-opacity":0.20000000298023224},"geometry":{"coordinates":[[[6.62792,53.161577],[6.628113,53.161561],[6.628446,53.161574],[6.628934,53.161664],[6.62975,53.161924],[6.6369,53.164989],[6.6472,53.171421],[6.660289,53.179703],[6.663637,53.182738],[6.664109,53.184474],[6.664087,53.18513],[6.66398,53.185426],[6.663808,53.18549],[6.662971,53.185374],[6.661963,53.185066],[6.660246,53.184487],[6.658101,53.18351],[6.641921,53.173968],[6.632523,53.167331],[6.628167,53.162841],[6.627845,53.162352],[6.627802,53.161973],[6.627888,53.161696],[6.62792,53.161577]]],"type":"Polygon"},"id":"b97f3545a593268cd2e3893a9d08fe59"}],"id":"davidvisscher.nom58j6h"}';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
