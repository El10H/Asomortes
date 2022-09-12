<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\partner;
use Faker\Generator as Faker;

$factory->define(partner::class, function (Faker $faker) {
    return [

        'nombre'=>$faker->name,
        'apellido_paterno'=>$faker->lastName,
        'apellido_materno'=>$faker->lastName,
        'carne'=>$faker->numerify('######'),
        'fecha_de_ingreso'=>$faker->date,
        'fecha_de_nac'=>$faker->date,
        'distrito_nac'=>$faker->city,
        'provincia_nac'=>$faker->city,
        'dpto_nac'=>$faker->randomElement(['Lima','Piura','Trujillo','Tumbes']),
        'profesion'=>$faker->randomElement(['Ingeniero','Abogado','Médico','Profesor','Arquitecto','Diseñador']),
        'grado_de_instruccion'=>$faker->text(10),
        'actividad'=>$faker->text(10),
        'estado_civil'=>$faker->randomElement(['soltero','casado','divorciado','viudo']),
        'dni'=>$faker-> unique()-> numerify('########'),
        'domicilio'=>$faker->text(10),
        'distrito_actual'=>$faker->city,
        'provincia_actual'=>$faker->city,
        'dpto_actual'=>$faker->randomElement(['Lima','Piura','Trujillo','Tumbes']),
        'celular'=>$faker->numerify('#########'),
        'teléfono'=>$faker->numerify('######'),
        'email'=>$faker->unique()->safeEmail,
        //'fallecimiento'=>$faker->randomElement('SI','NO'),
        //'directivo'=>$faker->randomElement('SkfkdjfI','NO'),

        
    ];
});
