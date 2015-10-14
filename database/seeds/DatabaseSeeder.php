<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use UserTable\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); //unguards all DB transactions to get a unsafe DB state.

        $this->call(UserTableSeeder::class);

        Model::reguard(); //reinstate all the guards.
    }
}
