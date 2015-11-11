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
        Task_Type::create([
            'name' => 'observation'
        ]);

        Task_Type::create([
            'name' => 'earthquake'
        ]);

        Task_Type::create([
            'name' => 'measurement'
        ]);
    }
}
