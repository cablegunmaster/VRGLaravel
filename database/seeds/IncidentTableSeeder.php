<?php namespace IncidentTable;

use App\Incident;
use Illuminate\Database\Seeder;


class IncidenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Incident::class, 20)->create();
    }
}
