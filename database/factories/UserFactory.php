<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
    $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'cpf' => $faker->cpf(false),
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'role' => 'customer',
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeBetween('-3 years', 'now')
    ];
});
