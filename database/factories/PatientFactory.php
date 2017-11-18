<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Patient::class, function (Faker $faker) {
    return [
        'medical_record_number' => $faker->numberBetween($min = 1000, $max = 9999),
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'sex' => $faker->boolean,
        'physician' => $faker->name,
        'room' => $faker->bothify('###?'),
    ];
});
