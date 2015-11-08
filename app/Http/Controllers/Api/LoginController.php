<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 11/8/2015
 * Time: 2:36 PM
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Input;


class LoginController extends Controller
{
    public function loginRequest() {
        $result = array();
        $result['success'] = false;

        if(Input::has('username') && Input::has('password')) {
            $user = User::where('username', Input::get('username'))->where('password', Input::get('password'))->first();
            if($user != null) {
                $result['success'] = true;
                $result['token'] = $user->token;
            }
        }
        return json_encode($result);
    }
}