<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->text(20),
        'descripcion'=>$faker->text(200),

    ];
});