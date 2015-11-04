<?php namespace TeamTable;

use Illuminate\Database\Seeder;
use App\Team;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Team::create([
    		'id' => 1,
    		'code' => '34W001',
    		'name'=> 'Uithuizermeeden',
    		'lat' => 53.410576,
    		'lon' => 6.703271,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 2,
    		'code' => '34W002',
    		'name'=> 'Loppersum',
    		'lat' => 53.334268,
    		'lon' => 6.745593,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 3,
    		'code' => '34W003',
    		'name'=> 'Bierum',
    		'lat' => 53.380980,
    		'lon' => 6.857106,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 4,
    		'code' => '34W004',
    		'name'=> 'Wagenborgen',
    		'lat' => 53.258505,
    		'lon' => 6.926023,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 5,
    		'code' => '34W005',
    		'name'=> 'Zoutkamp',
    		'lat' => 53.338086,
    		'lon' => 6.302255,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 6,
    		'code' => '34W006',
    		'name'=> 'Grijpskerk',
    		'lat' => 53.263484,
    		'lon' => 6.310488,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 7,
    		'code' => '34W007',
    		'name'=> 'Ten Boer',
    		'lat' => 53.277517,
    		'lon' => 6.694064,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 8,
    		'code' => '34W008',
    		'name'=> 'Haren',
    		'lat' => 53.170891,
    		'lon' => 6.599679,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 9,
    		'code' => '34W009',
    		'name'=> 'Hoogezand-Sappemeer',
    		'lat' => 53.167901,
    		'lon' => 6.768314,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 10,
    		'code' => '34W010',
    		'name'=> 'Veendam',
    		'lat' => 53.113891,
    		'lon' => 6.862050,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 11,
    		'code' => '34W011',
    		'name'=> 'Winschoten',
    		'lat' => 53.155172,
    		'lon' => 7.025228,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 12,
    		'code' => '34W012',
    		'name'=> 'Stadskanaal',
    		'loat' => 52.980136,
    		'lon' => 6.966552,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 13,
    		'code' => '34W013',
    		'name'=> 'Vlagtwedde',
    		'lat' => 53.0271506,
    		'lon' => 7.1047893,
    		'leader_id' => 1
    		]);
    	Team::create([
    		'id' => 14,
    		'code' => '34W014',
    		'name'=> 'Ter Apel',
    		'lat' => 52.8752196,
    		'lon' => 7.0635266,
    		'leader_id' => 1
    		]);
    }

}
