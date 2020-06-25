<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'apto' => $faker->randomNumber(4),
        'number' => $faker->buildingNumber
    ];
});
