<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\MarEntry::class, function (Faker $faker) {
    return [
      'medical_record_number' => function() {
          return factory(App\Patient::class)->create()->medical_record_number;
      },
      'medication_id' => function() {
          return factory(App\Medication::class)->create()->medication_id;
      },
      'stat' => $faker->boolean,
      'instructions' => $faker->words(6, true),
      'given_at' => $faker->numberBetween($min = 1, $max = 8191),
    ];
});
