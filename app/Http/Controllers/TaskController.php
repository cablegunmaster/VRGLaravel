<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$tasks = Task::all();
		return view('task.index')->with('tasks', $tasks);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index_formatted()
	{
		$tasks = Task::all();
		return view('task.preformatted')->with('tasks', $tasks);
	}

	public function getLatestZero()
	{
		return $this->getLatest(0);
	}

	public function getLatestForTeam()
	{
		$team_id = $_POST['team'];
		return($this->getLatest($team_id));
	}

	public function getLatestForTeamZeroPlain()
	{
		$team_id = 0;
		$task = Task::where('team_id',$team_id)->orderBy('updated_at','asc')->first();
		if($task == null)
		{
			return "";
		}
		return view('task.plaintext')->with('task',$task);
	}

	public function getLatestForTeamPlain()
	{
		$team_id = $_POST['team'];
		$task = Task::where('team_id',$team_id)->orderBy('updated_at','asc')->first();
		if($task == null)
		{
			return "";
		}
		return view('task.plaintext')->with('task',$task);
	}

	public function getLatest($team_id)
	{
		$task = Task::where('team_id',$team_id)->orderBy('updated_at','asc')->first();
		
		if($task == null)
		{
			$task = array('success' => false, 'message' => "No task found for team ".$team_id);
		}
		else
		{
			$task["success"] = true;
		}
		return json_encode($task);
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
