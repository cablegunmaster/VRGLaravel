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
                            "iconUrl": "/brandweer/img/obstruction.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        Poi_Type::create([
            'name' => 'mal',
            'properties'=> '"type": "mal"'
            //Mal =
            // "coordinates": [
//            [ [100.0, 0.0], [101.0, 0.0], [101.0, 1.0],
//            [100.0, 1.0], [100.0, 0.0] ]
//            ]
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
                            "iconUrl": "/brandweer/img/meting.png",
                            "iconSize": [35,17],
                            "className": "dot"
                            }'
        ]);

        Poi_Type::create([
            'name' => 'waarneming',
        ]);
    }
}
