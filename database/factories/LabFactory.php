<?php

use App\Patient;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Lab::class, function (Faker $faker) {
    $name = $faker->words(2, true);
    return [
      'name' => $name,
      'description' => $faker->sentence(6, true),
      'file_path' => 'labs/' . $name . rand(1111, 9999) . '.pdf',
      'patient_id' => function() {
          return factory(App\Patient::class)->create()->medical_record_number;
      },
    ];
});

$factory->state(App\Lab::class, 'assigned', [
    'patient_id' => function() {
        return factory(App\Patient::class)->create()->medical_record_number;
    },
]);

$factory->state(App\Lab::class, 'unassigned', [
    'patient_id' => null,
]);
