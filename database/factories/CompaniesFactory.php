<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
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

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'phone' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'fax' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'first_address' => $faker->address,
        'second_address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
    ];
});
