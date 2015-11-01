<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use UserTable\UserTableSeeder;
use LocationTable\LocationTableSeeder;
use PoiTypeTable\PoiTypeTableSeeder;

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
        $this->call(LocationTableSeeder::class);
        $this->call(PoiTypeTableSeeder::class);

        Model::reguard(); //reinstate all the guards.
    }
}
