<?php namespace UserTable;

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$gerrit  = User::create([
    		'id' => 1,
    		'team_id' =>1,
    		'name' => 'Gerrit Gerritsen',
    		'username' => 'gerrit',
    		'email' => 'gerrit@scrumbag.nl',
    		'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
    		'phone' => '0900GERRIT',
    		'remember_token' => '068c9087a94570e873ea3485f5f8c005'
    		]);
        factory(User::class, 50)->create();
    }

}
