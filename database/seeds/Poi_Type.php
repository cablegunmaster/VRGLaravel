<?php namespace PoiTypeTable;

use Illuminate\Database\Seeder;
use App\Poi_Type;
use DB;

class PoiTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Poi_Type')->insert([
            'name' => 'obstruction',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'mallen',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'destination',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'origin',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'waypoints',
        ]);
    }
}
