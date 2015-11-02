<?php

use App\Incident;
use App\Task;
use App\User;
use App\Location;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'team_id' => $faker->numberBetween(1,10),
        'username' => $faker->userName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Location::class, function (Faker\Generator $faker) {
   return [
       'user_id' => $faker->numberBetween(1,20),
       'task_id' => $faker->numberBetween(1,10),
       'lat' => 53.195+(mt_rand() / mt_getrandmax())/15,
       'lon'=> 6.53+(mt_rand() / mt_getrandmax())/15,
   ];
});


$factory->define(Incident::class, function (Faker\Generator $faker) {
    return [
        'code' => bcrypt(str_random(64)),
        'information' => sprintf("%s %s", $faker->city, $faker->streetName),
        'end_date' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});

$factory->define(Task::class, function (Faker\Generator $faker) {
    return [
        'code' => bcrypt(str_random(64)),
        'information' => sprintf("%s %s", $faker->city, $faker->streetName),
        'end_date' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
