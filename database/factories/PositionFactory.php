<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Position;
use App\User;
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

$factory->define(Position::class, function (Faker $faker) {
    $company_id = factory(Company::class , 1)->create()->first();
    return [
        'description' => $faker->word,
        'target' => $faker->randomElement($array = array('driver' , 'employee')),
        'company_id' =>$company_id->id,
    ];
});
