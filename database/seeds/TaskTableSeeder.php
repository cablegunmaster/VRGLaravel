<?php namespace TaskTable;

use App\Task;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'incident_id' => '2',
            'task_type_id' => '1',
            'team_id' => '1',
        ]);
        Task::create([
            'incident_id' => '1',
            'task_type_id' => '2',
            'team_id' => '1',
        ]);
    }
}
