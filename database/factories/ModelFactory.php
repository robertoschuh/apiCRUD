<?php

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function(Faker\Generator $faker){

    return [
        'title'   => $faker->sentence,
        'content' => $faker->paragraph,
        'pending' => true, //$faker->boolean(),
        'user_id' => function (){
           // dd('it runs');
            // If we pass a custom user_id , it never runs.
            return factory(\App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Comment::class, function(Faker\Generator $faker){
   return [
       'comment' => $faker->paragraph,
       'post_id' => function () {
            // Only runs if there are not a custom post_id.
            return factory(\App\Post::class)->create()->id;
       },
       'user_id' => function (){
           // dd('it runs');
           // If we pass a custom user_id , it never runs.
           return factory(\App\User::class)->create()->id;
       },
   ];
});