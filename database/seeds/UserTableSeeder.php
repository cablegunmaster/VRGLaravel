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

        User::create([
            'id' => 2,
            'team_id' =>2,
            'name' => 'Ivo Opstelten',
            'username' => 'ivootje44',
            'email' => 'xXxivootje44xXx@live.nl',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0800BONNETJE',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 3,
            'team_id' =>3,
            'name' => 'Teamleider 3',
            'username' => 'Teamleider 3',
            'email' => 'Teamleider 3',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 4,
            'team_id' =>4,
            'name' => 'Teamleider 4',
            'username' => 'Teamleider 4',
            'email' => 'Teamleider 4',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 5,
            'team_id' =>5,
            'name' => 'Teamleider 5',
            'username' => 'Teamleider 5',
            'email' => 'Teamleider 5',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 6,
            'team_id' =>6,
            'name' => 'Teamleider 6',
            'username' => 'Teamleider 6',
            'email' => 'Teamleider 6',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 7,
            'team_id' =>7,
            'name' => 'Teamleider 7',
            'username' => 'Teamleider 7',
            'email' => 'Teamleider 7',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 8,
            'team_id' =>8,
            'name' => 'Teamleider 8',
            'username' => 'Teamleider 8',
            'email' => 'Teamleider 8',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 9,
            'team_id' =>9,
            'name' => 'Teamleider 9',
            'username' => 'Teamleider 9',
            'email' => 'Teamleider 9',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 10,
            'team_id' =>10,
            'name' => 'Teamleider 10',
            'username' => 'Teamleider 10',
            'email' => 'Teamleider 10',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 11,
            'team_id' =>11,
            'name' => 'Teamleider 11',
            'username' => 'Teamleider 11',
            'email' => 'Teamleider 11',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 12,
            'team_id' =>12,
            'name' => 'Teamleider 12',
            'username' => 'Teamleider 12',
            'email' => 'Teamleider 12',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 13,
            'team_id' =>13,
            'name' => 'Teamleider 13',
            'username' => 'Teamleider 13',
            'email' => 'Teamleider 13',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 14,
            'team_id' =>14,
            'name' => 'Teamleider 14',
            'username' => 'Teamleider 14',
            'email' => 'Teamleider 14',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        User::create([
            'id' => 15,
            'team_id' =>15,
            'name' => 'Teamleider 15',
            'username' => 'Teamleider 15',
            'email' => 'Teamleider 15',
            'password' => '$2a$10$vm1Dp9TiNo/awkt7EutWVOW2a4ZZJcSXJDHH4K0jh.2Df6Eoo1/TW',
            'phone' => '0900GERRIT',
            'remember_token' => '068c9087a94570e873ea3485f5f8c005'
            ]);
        factory(User::class, 50)->create();
    }

}
