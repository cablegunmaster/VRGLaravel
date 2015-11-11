<?php namespace TaskTypeTable;

use Illuminate\Database\Seeder;
use App\Task_Type;
use DB;

class TaskTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_type')->insert([
            'name' => 'observation'
        ]);

        DB::table('task_type')->insert([
            'name' => 'earthquake'
        ]);
        DB::table('task_type')->insert([
            'name' => 'measurement'
        ]);
    }
}