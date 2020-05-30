<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Genre;
use App\Img;
use App\Tipe;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'inventory'   => rand(0, 100),
        'price'     => $faker->randomFloat(2, 0, 150),
        'slug'      => $faker->slug
    ];
});
