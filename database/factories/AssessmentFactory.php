<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Assessment::class, function (Faker $faker) {
    return [
      'student_name' => $faker->words(2, true),
      'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'start_time' => $faker->numberBetween($min = 1000, $max = 9999),
      'end_time' => $faker->numberBetween($min = 1000, $max = 9999),
      'medical_record_number' => function() {
          return factory(App\Patient::class)->create()->medical_record_number;
      },
      'reason' => $faker->sentence,
      'temperature' => $faker->randomFloat(2, 0, 999),
      'bp_over' => $faker->randomNumber,
      'bp_under' => $faker->randomNumber,
      'apical_pulse' => $faker->randomNumber,
      'respiration' => $faker->randomNumber,
      'oximetry' => $faker->randomNumber,
      'automatic' => $faker->boolean,
      'allergies' => $faker->word,
      'loc' => $faker->word,
      'orientation' => $faker->word,
      'speech' => $faker->word,
      'behavior' => $faker->word,
      'memory' => $faker->word,
      'pupillary' => $faker->word,
      'pain' => $faker->sentence,
      'skincolor' => $faker->word,
      'skintemp' => $faker->words(2, true),
      'hydration' => $faker->words(2, true),
      'integrity' => $faker->word,
      'dressings' => $faker->sentence,
      'ivsite' => $faker->sentence,
      'centrallines' => $faker->sentence,
      'heartrhythm' => $faker->word,
      'radial' => $faker->words(2, true),
      'capillary' => $faker->word,
      'upper' => $faker->words(2, true),
      'breathrhythm' => $faker->word,
      'cough' => $faker->word,
      'secretions' => $faker->words(4, true),
      'roomair' => $faker->words(2, true),
      'nausea' => $faker->word,
      'abdomen' => $faker->word,
      'bowel' => $faker->words(3, true),
      'stool' => $faker->sentence,
      'tubefeeding' => $faker->sentence,
      'genitourinary' => $faker->sentence,
      'motion' => $faker->word,
      'muscle' => $faker->words(3, true),
      'pedal' => $faker->sentence,
      'lower' => $faker->words(2, true),
      'peripheral' => $faker->sentence,
      'ted' => $faker->word,
      'restraints' => $faker->word,
      'drainage' => $faker->word,
      'activity' => $faker->words(4, true),
    ];
});
