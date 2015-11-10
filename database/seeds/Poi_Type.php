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
        DB::table('POI_Type')->insert([
            'name' => 'obstruction',
            'properties' => '"type": "obstruction",
                            "icon": {
                            "iconUrl": "http://scrumbag.nl/brandweer/img/obstruction.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        DB::table('POI_Type')->insert([
            'name' => 'mal',
            'properties'=> '"type": "mal"'
        ]);

        DB::table('POI_Type')->insert([
            'name' => 'origin',
        ]);

        DB::table('POI_Type')->insert([
            'name' => 'destination',
        ]);

        DB::table('POI_Type')->insert([
            'name' => 'waypoints',
        ]);

        DB::table('POI_Type')->insert([
            'name' => 'meting',
            'properties'=> '"type": "meting",
                            "icon": {
                            "iconUrl": "http://scrumbag.nl/brandweer/img/meting.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        DB::table('POI_Type')->insert([
            'name' => 'waarneming'
        ]);
    }
}
