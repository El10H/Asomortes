<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            //Llave primaria y creación de llave foranea
            $table->bigIncrements('id');
            //Datos del socio
            $table->string('nombre',50);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->string('carne', 10);
            $table->date('fecha_de_ingreso');
            $table->date('fecha_de_nac');
            $table->string('distrito_nac',50);
            $table->string('provincia_nac',50);
            $table->string('dpto_nac',50);
            $table->string('profesion',50)->nullable();
            $table->string('grado_de_instruccion',50)->nullable();
            $table->string('actividad',25);
            $table->string('estado_civil',15);
            $table->string('Dni',8);
            $table->string('domicilio',50);
            $table->string('distrito_actual',50);
            $table->string('provincia_actual',50);
            $table->string('dpto_actual',50);
            $table->string('celular',9);
            $table->string('teléfono',9);
            $table->string('email',50);
            $table->string('fallecimiento')->default('no');
            $table->string('directivo')->default('no');
            $table->string('estado')->default('Activo');
        
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
