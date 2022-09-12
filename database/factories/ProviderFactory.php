<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\provider;
use Faker\Generator as Faker;

$factory->define(provider::class, function (Faker $faker) {
    return [
        'razon_social'=>$faker->text(50),
        'ruc'=>$faker->numerify('###########'),
        'direccion'=>$faker->text(100),
        'telefono'=>$faker->numerify('#########'),
        'email'=>$faker->unique()->safeEmail,
    ];
});