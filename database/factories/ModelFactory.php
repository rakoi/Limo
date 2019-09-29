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
        'username'=>$faker->username,
        'birthday'=>'12/12/12',
        'Location'=>'Nairobi,Kenya',
        'password' => $password ?: $password = bcrypt('secret'),
        'photo'=>'mysteryman.jpeg',
        'remember_token' => str_random(10),
    ];
});
  $factory->define(App\Post::class,function(Faker\Generator $faker){

 	return[
 	'moviename'=>$faker->name,
 	'rating'=>rand(1,10),
 	'comment'=>$faker->paragraph(3),
 	'user_id'=>rand(1,50),


 	];
 });

  $factory->define(App\Series::class,function(Faker\Generator $faker){
        return[
            'series_name'=>$faker->name,
            'current_season'=>rand(1,3),
            'current_episode'=>rand(1,22),
    ];
    });

  $factory->define(App\Watchlist::class,function(Faker\Generator $faker){
        return [
            'user_id'=>rand(1,49),
            'current_season'=>rand(1,3),
            'current_episode'=>rand(1,22),
            'series_id'=>rand(1,49),
        ];
  });