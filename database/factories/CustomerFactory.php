<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\User;
use App\Employee;
use App\Driver;
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

$factory->define(Customer::class, function (Faker $faker) {
    $user_id=factory(User::class , 1)->create()->first();
    return [
        'mc_number' => $faker->randomDigit,
        'dot_number' => $faker->randomDigit,
        'website' => 'www.anything.com',
        'invoive_factoring_approvment' => true,
        'invoice_mail' => true,
        'personal_fax' => $faker->randomDigit,
        'business_fax' => $faker->randomDigit,
        'user_id'=>$user_id->id,
        'is_deleted'=>false

    ];
});
