<?php

namespace App\Http\Controllers\Api;

use App\User;
use Hash;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * Login resource is based on the username and password.
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(Auth::attempt(['username' => $username, 'password' => $password])) {
            $user = User::where('username', $username)->first();
            return json_decode('{ "token" : "'.$user->remember_token.'" } ',true);
        }else{
            return json_decode('{ "error" : "de Username of Wachtwoord is verkeerd ingevoerd." } ',true);
        }
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
