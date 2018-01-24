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
        'height' => $faker->numerify('## in.'),
        'weight' =>  $faker->numerify('### lbs'),
        'diagnosis' => $faker->words(3, true),
        'allergies' => $faker->words(6, true),
        'code_status' => $faker->randomElement($array = array ['FULL CODE','DNR','DNI']),
        'physician' => $faker->name,
        'room' => $faker->bothify('###?'),
    ];
});
