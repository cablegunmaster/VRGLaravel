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
            'properties' => '"type": "obstruction",
                            "icon": {
                            "iconUrl": "/brandweer/img/obstruction.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'mal',
            'properties'=> '"type": "mal"'
            //Mal =
            // "coordinates": [
//            [ [100.0, 0.0], [101.0, 0.0], [101.0, 1.0],
//            [100.0, 1.0], [100.0, 0.0] ]
//            ]
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'origin',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'destination',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'waypoints',
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'meting',
            'properties'=> '"type": "meting",
                            "icon": {
                            "iconUrl": "/brandweer/img/meting.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        DB::table('Poi_Type')->insert([
            'name' => 'waarneming',
        ]);
    }
}
