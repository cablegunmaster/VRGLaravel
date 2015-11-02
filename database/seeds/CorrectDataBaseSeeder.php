<?php namespace UserTable;

use App\Incident;
use App\Incident_User;
use App\Task;
use App\Task_Status;
use App\Team;
use Illuminate\Database\Seeder;
use App\User;

class CorrectDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
            'id' => 1,
            'code' => '34W001',
            'information'=> 'Groningen Sontweg',
            'end_date' => 1446469200,
            'created_at' => 1446465600,
            'updated_at' => 0
        ]);
        Incident_User::create([
            'incident_id' => 1,
            'user_id' => 1,
            'created_at' => 1446465600,
            'updated_at' => 0
        ]);
        Task::create([
            'id' => 1,
            'incident_id' => 1,
            'team_id' => 1,
            'task_type_id' => 1,
            'title' => 'GEEN TITEL',
            'description' => 'GEEN DESC',
            'data' => 'GEEN DATA',
            'dest_lat' => 53.195+(mt_rand() / mt_getrandmax())/15,
            'dest_lon'=> 6.53+(mt_rand() / mt_getrandmax())/15,
            'dest_text' => 'Groningen Sontweg',
            'created_at' => 1446465600,
            'updated_at' => 0,
        ]);
        Task_Status::create([
            'id' => 1,
            'task_id' => 1,
            'user_id'=> 1,
            'receive_date' => 0,
            'created_at' => 1446465600,
            'updated_at' => 0
        ]);
        Team::create([
            'id' => 1,
            'code' => '34W001',
            'name'=> 'Uithuizermeeden',
            'lat' => 53.195+(mt_rand() / mt_getrandmax())/15,
            'lon'=> 6.53+(mt_rand() / mt_getrandmax())/15,
            'created_at' => 1446465600,
            'updated_at' => 0
        ]);
        User::create([
            'id' => 1,
            'name' => "Gerrit",
            'team_id' => 1,
            'username' => "Gerrit",
            'email' => "gerrit@scrumhack.nl",
            'phone' => "06-belmij",
            'password' => "GerritPass",
            'remember_token' => "GerritToken",
        ]);
    }
}
