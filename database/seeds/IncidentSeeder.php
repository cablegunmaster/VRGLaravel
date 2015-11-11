<?php namespace IncidentTable;

use App\Incident;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
            'code' =>'8000',
            'information' => 'Gerrit is vermist in de rook!',
            'weather' => '{"type":"Rain","description":"lichte regen","temperature":13,"wind_speed":8,"wind_degrees":241}',
        ]);
        Incident::create([
            'code' =>'8000',
            'information' => 'Gerrit is zit in de wolken!',
            'weather' => '',
        ]);
    }
}
