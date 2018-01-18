<?php
use App\Order;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        $name = $faker->words(2, true);
        'name' => $name,
        'description' => $faker->sentence(6, true),
        'file_path' => 'orders/' . $name . rand(1111, 9999) . '.pdf',
        'patient_id' => function() {
            return factory(App\Patient::class)->create()->medical_record_number;
        },
        'completed' => $faker->boolean,
    ];
});
