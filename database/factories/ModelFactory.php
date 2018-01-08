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

//Faker for articles
$factory->define(App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = false),
        'content' => $faker->words(220, true),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});

//Faker for contact form
$factory->define(App\Contact::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'object' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->words(40, true),
    ];
});

//Faker for comments
$factory->define(App\Commentary::class, function (Faker\Generator $faker) {

    return [
        'content' => $faker->words(20, true),
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'article_id' => $faker->numberBetween($min = 1, $max = 30),
    ];
});