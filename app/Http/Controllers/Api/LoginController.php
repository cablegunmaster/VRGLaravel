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
            $json = array(
              'success' => true,
                'token' =>$user->remember_token
            );
            return json_encode($json);
        }else{
            $json = array(
              'succes' => false
            );
            return json_encode($json);
        }
    }

    /**
     * Test of de token nog bestaat in de username.
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $token = $_POST['token'];

        $user = User::where("remember_token", "=", $token)->firstOrFail();
        if(isset($user->remember_token) && !empty($user->remember_token)) {
            $json = array(
                'success' => true
            );
            return json_encode($json);
        }
        $json = array(
            'succes' => false
        );
        return json_encode($json);
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
