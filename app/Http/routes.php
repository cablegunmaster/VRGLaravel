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
Route::get('/', function () {
    //return view('welcome');
    return view('mock.index');
});

Route::get('/user/{id}', 'UserController@show');
Route::get('/user', 'UserController@index');
Route::get('/user/{id}/delete', 'UserController@destroy');



