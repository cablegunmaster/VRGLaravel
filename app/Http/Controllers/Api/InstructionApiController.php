<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Incident;
use App\Task_Status;
use App\User;
use App\Task;
use DateTime;
use Input;

class InstructionApiController extends Controller
{
    public function getInstruction()
    {
        $result = array();
        $result['success'] = false;

        if(Input::has('token'))
        {
            $user = User::where('remember_token', Input::get('token'))->first();
            // $result['user'] = $user;

            $incident = Incident::find(1);
            // $result['$incident'] = $incident;

            $task = Task::where('incident_id', $incident->id)->where('team_id', $user->team_id)->orderBy('id')->first(); // user->team_id);
            $result['task'] = $task;
            $result['success'] = true;
        }
        return json_encode($result);
    }
    public function ackInstruction()
    {
        $result = array();
        $result['success'] = false;

        if(Input::has('token') && Input::has('task_id'))
        {
            $user = User::where('remember_token', Input::get('token'))->first();
            if($user != null) {
                $status = Task_Status::where('task_id', Input::get('task_id'))->where('user_id', $user->id)->first();
                if($status != null) {
                    $status->receive_date = new DateTime();
                    $status->save();
                    $result['status'] = $status;
                    $result['success'] = true;
                }
                else {
                    $result['error'] = "INVALID_TOKEN_AND_TASK_ID";
                }
            }
            else {
                $result['error'] = "INVALID_TOKEN";
            }
        }
        else {
            $result['error'] = "MISSING_INPUT";
        }
        return json_encode($result);
    }
    public function ackInstructionComplete()
    {
        $result = array();
        $result['success'] = false;

        if (Input::has('token') && Input::has('task_id')) {
            $user = User::where('remember_token', Input::get('token'))->first();
            if ($user != null) {
                $task = Task::where('id', Input::get('task_id'))->where('end_date', '<', 1)->orderBy('id')->first();;
                if ($task != null) {
                    $task->end_date = new DateTime();
                    $task->save();
                    $result['task'] = $task;
                    $result['success'] = true;
                }
                else {
                    $result['error'] = "INVALID_NO_TASK";
                }
            } else {
                $result['error'] = "INVALID_TOKEN";
            }
        }
        else {
            $result['error'] = "MISSING_INPUT";
        }
        return json_encode($result);
    }
}