<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Position;
use App\Company;
use App\Driver;
use App\Customer;
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

$factory->define(Employee::class, function (Faker $faker) {
    $Position_id=factory(Position::class , 1)->create()->first();
    $Company_id=factory(Company::class , 1)->create()->first();
    $user_id=factory(User::class , 1)->create()->first();
    return [
        'position_id' => $Position_id->id,
        'company_id' =>$Company_id->id,
        'user_id'=>$user_id->id,
        'birth' => $faker->dateTime($max = 'now', $timezone = null),
        'pay_rate_per_hour' => $faker->randomDigit,
        'education' => 'B.degree',
        'is_deleted'=>false

    ];
});
