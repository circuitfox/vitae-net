<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Medication::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'dosage_amount' => $faker->randomNumber,
        'dosage_unit' => $faker->word,
        'comments' => $faker->sentence,
    ];
});
