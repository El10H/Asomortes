<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\service;
use Faker\Generator as Faker;

$factory->define(service::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->text(20),
        'descripcion'=>$faker->text(200),
        'valor'=>$faker->randomFloat(2, 1, 100)
    ];
});