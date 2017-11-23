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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => $faker->jobTitle,
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\User::class, 'admin', function (Faker $faker) {
    return [
        'role' => 'admin',
    ];
});

$factory->state(App\User::class, 'instructor', function (Faker $faker) {
    return [
        'role' => 'instructor',
    ];
});

$factory->state(App\User::class, 'reset_password', function (Faker $faker) {
    return [
        'reset_password' => true,
    ];
});
