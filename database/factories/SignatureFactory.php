<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Signature::class, function (Faker $faker) {
    return [
      'medical_record_number' => function() {
          return factory(App\Patient::class)->create()->medical_record_number;
      },
      'medication_id' => function() {
          return factory(App\Medication::class)->create()->medication_id;
      },
      'time' => $faker->numberBetween($min = 7, $max = 19) . ':' . $faker->numberBetween($min = 0, $max = 59),
      'student_name' => $faker->firstName . ' ' . $faker->lastName,
    ];
});
