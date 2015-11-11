<?php namespace PoiTypeTable;

use Illuminate\Database\Seeder;
use App\Poi_Type;

class PoiTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Poi_Type::create([
            'name' => 'obstruction',
            'properties' => '"type": "obstruction",
                            "icon": {
                            "iconUrl": "http://scrumbag.nl/brandweer/img/obstruction.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        Poi_Type::create([
            'name' => 'mal',
            'properties'=> '"type": "mal"'
        ]);

        Poi_Type::create([
            'name' => 'origin',
        ]);

        Poi_Type::create([
            'name' => 'destination',
        ]);

        Poi_Type::create([
            'name' => 'waypoints',
        ]);

        Poi_Type::create([
            'name' => 'meting',
            'properties'=> '"type": "meting",
                            "icon": {
                            "iconUrl": "http://scrumbag.nl/brandweer/img/meting.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        Poi_Type::create([
            'name' => 'observation',
        ]);

        Poi_Type::create([
            'name' => 'earthquake',
        ]);
    }
}
