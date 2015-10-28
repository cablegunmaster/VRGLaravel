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

/**
 * Base route is '/brandweer/' ipv '/' online vanwege de mappenstructuur waarin Laravel zich nu bevind.
 */
Route::get('/brandweer/', function () {
    return view('index');
});

Route::get('/brandweer/user/{id}', 'UserController@show');
Route::get('/brandweer/user', 'UserController@index');
Route::get('/brandweer/user/{id}/delete', 'UserController@destroy');
Route::get('/brandweer/randomadres', 'MapController@random');


/**
 * Team Routes
 */

Route::get('/brandweer/team', 'TeamController@index');

/**
 * Algemene instructie
 */
Route::get('/brandweer/instructions', 'InstructionController@create'); // creates form crud form.
Route::get('/brandweer/instructions', 'InstructionController@store');  // stores the form in the database.

/**
 * Api calls.
 */

//Upload a image to the server.
Route::post('/brandweer/api/upload_image', 'Api\ApiController@upload_image');
Route::get('/brandweer/api/upload_image', 'Api\ApiController@CreateUpload_image');

//location call. All firetruck call.
Route::get('/brandweer/api/getlocations', 'Api\LocationController@index');
