<?php namespace IncidentUserTable;

use App\Incident_User;
use Illuminate\Database\Seeder;

class IncidentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident_User::create([
            'incident_id' => '1',
            'user_id' =>    '1',
        ]);

        Incident_User::create([
            'incident_id' => '2',
            'user_id' =>    '1',
        ]);

        Incident_User::create([
            'incident_id' => '1',
            'user_id' =>    '2',
        ]);
    }
}
