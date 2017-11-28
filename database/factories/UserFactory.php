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
        'password' => $password ?: $password = bcrypt(config('auth.default_password')),
        'role' => $faker->jobTitle,
        'remember_token' => str_random(10),
        'reset_password' => false,
    ];
});

$factory->state(App\User::class, 'admin', [
    'role' => 'admin',
]);

$factory->state(App\User::class, 'instructor', [
    'role' => 'instructor',
]);

$factory->state(App\User::class, 'reset_password', [
    'reset_password' => true,
]);
