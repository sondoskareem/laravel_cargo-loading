<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Customer;
use App\Employee;
use App\Load;
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

$factory->define(Load::class, function (Faker $faker) {
    $employee = Employee::first();
    $customer = Customer::first();
    return [
        'customer_id' => $employee->id,
        'employee_id' => $customer->id,
        'po_load' => $faker->word,
        'load_rate' => $faker->randomDigit,
        'loaded_mile' => $faker->randomDigit,
        'load_type' => $faker->word,
        'trailer_type' => $faker->word,
        'endorsements' => $faker->boolean,
        'number_of_stop' => 1,
        'trailer_model' => 'Big Trailer',
        'status' => 'binding',

    ];
});
