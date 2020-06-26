<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Driver;
use App\Position;
use App\User;
use App\Employee;
use App\Customer;
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

$factory->define(Driver::class, function (Faker $faker) {
    $Position_id=factory(Position::class , 1)->create()->first();
    $Company_id=factory(Company::class , 1)->create()->first();
    $user_id=factory(User::class , 1)->create()->first();

    return [
        'position_id' => $Position_id->id,
        'company_id' =>$Company_id->id,
        'user_id'=>$user_id->id,
        'birth' => $faker->dateTime($max = 'now', $timezone = null),
        'home_terminal' => $faker->word,
        'dl_hash' => $faker->randomDigit,
        'state' => $faker->word,
        'endorsements' => $faker->word,
        'hazmat' => $faker->boolean,
        'tanker' => $faker->boolean,
        'double_triple' => $faker->boolean,
        'dl_exp' => $faker->dateTime($max = 'now', $timezone = null),
        'medical_exp' => $faker->dateTime($max = 'now', $timezone = null),
        'pay_rate' => $faker->randomDigit,
        'profile_image'=>"/uploads/images/any_1592849855.jpg"

    ];
});
