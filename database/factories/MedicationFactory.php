<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Medication::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'dosage_amount' => $faker->randomNumber,
        'dosage_unit' => $faker->word,
        'second_amount' => $faker->randomNumber,
        'second_unit' => $faker->word,
        'second_type' => $faker->randomElement($array = ['combo', 'amount', 'in']),
        'comments' => $faker->sentence,
    ];
});

$factory->state(App\Medication::class, 'secondary_name', function (Faker $faker) {
    return [
        'name' => $faker->word . '|' . $faker->word,
    ];
});
