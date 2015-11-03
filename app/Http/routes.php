<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Response;

Route::get('/', function () {
    return (new Response("", "200"))->header('Location', '/brandweer/ ');
});
/**
 * Base route is '/brandweer/' ipv '/' online vanwege de mappenstructuur waarin Laravel zich nu bevind.
 */
Route::get('/brandweer/', function () {
    return view('map');
});

Route::get('/brandweer/user/{id}', 'UserController@show');
Route::get('/brandweer/user', 'UserController@index');
Route::get('/brandweer/user/{id}/delete', 'UserController@destroy');
Route::get('/brandweer/randomadres', 'MapController@random');
Route::post('/brandweer/api/roadblock/new', 'Api\RoadblockController@newRoadBlock');
Route::post('/brandweer/api/roadblock/load', 'Api\RoadblockController@loadRoadBlock');
Route::post('/brandweer/api/roadblock/delete', 'Api\RoadblockController@deleteRoadBlock');


/**
 * Team Routes
 */

Route::get('/brandweer/team', 'TeamController@index');

/**
 * Task Routes
 */

Route::get('/brandweer/task/', 'TaskController@index');
Route::get('/brandweer/task/preformatted', 'TaskController@index_formatted');

/**
 * Algemene instructie
 */
Route::get('/brandweer/instructions/create', 'InstructionController@create'); // creates form crud form.
Route::post('/brandweer/instructions', 'InstructionController@store');  // stores the form in the database.

/**
 * meet instructie
 */
Route::get('/brandweer/meetinstructie/create', 'TaskMeasurementController@create'); // crud form.
Route::post('/brandweer/meetinstructie/store', 'TaskMeasurementController@store'); // store in db.

/**
 * Api calls.
 */
//Upload a image to the server.
Route::post('/brandweer/api/observation_upload', 'Api\ApiController@observation_upload');
Route::get('/brandweer/api/upload_image', 'Api\ApiController@CreateUpload_image');

//location call. All firetruck call.
Route::get('/brandweer/api/getlocations', 'Api\LocationController@index');
Route::get('/brandweer/api/getRoadblocks', 'Api\RoadblockController@index');

//Incident info API
Route::get('/brandweer/api/incident/getcurrent','IncidentController@getLatestJSON');

//Get latest task
Route::get('/brandweer/api/task/getcurrent','TaskController@getLatestZero');
Route::post('/brandweer/api/task/getcurrent','TaskController@getLatestForTeam');

Route::get('/brandweer/bullshitmal','Api\LocationController@bullshitMal');