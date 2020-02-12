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
        'estoque'   => rand(0,100),
        'price'     => $faker->randomFloat(2, 0, 150),
        'img_ref'   => rand(1, Img::all()->count()),
        'tipe_ref'  => rand(1, Tipe::all()->count()),
        'genre_ref' => rand(1, Genre::all()->count())
    ];
});
