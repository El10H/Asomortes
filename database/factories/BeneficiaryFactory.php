<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\beneficiary;
use Faker\Generator as Faker;

$factory->define(beneficiary::class, function (Faker $faker) {
    return [

        'partner_id'=>$faker->numberBetween(1,19),
        'nombre'=>$faker->name,
        'apellido_paterno'=>$faker->lastName,
        'apellido_materno'=>$faker->lastName,
        'dni'=>$faker->numerify('########'),
        'celular'=>$faker->numerify('#########'),
        'email'=>$faker->unique()->safeEmail,
        'parentesco'=>$faker->randomElement(['Hijo','Esposo','Hermano','Primo']),
        'fecha_de_ingreso'=>$faker->date,

    ];
});
