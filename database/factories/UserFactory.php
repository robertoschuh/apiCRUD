<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// Definiendo los factories para registered users.
$factory->defineAs(App\User::class, 'registered', function (Faker $faker) {

    return [
        'id' => $faker->uuid,
        'forename' => $faker->name,
        'email' => $faker->safeEmail,
        'surname' => $faker->unique()->name,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
     
   //     'verified' => 1,
    ];
});