<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'number' => $this->faker->randomNumber(8),
        'total_price' => $this->faker->numberBetween(25000, 200000),
        'payment_status' => 1,
    ];
});
