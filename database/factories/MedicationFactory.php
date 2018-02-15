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

$factory->state(App\Medication::class, 'no_secondary', function (Faker $faker) {
    return [
        'second_type' => null
    ];
});

$factory->state(App\Medication::class, 'combo', function (Faker $faker) {
    return [
        'second_type' => 'combo'
    ];
});

$factory->state(App\Medication::class, 'amount', function (Faker $faker) {
    return [
        'second_type' => 'amount'
    ];
});

$factory->state(App\Medication::class, 'in', function (Faker $faker) {
    return [
        'second_type' => 'in'
    ];
});
