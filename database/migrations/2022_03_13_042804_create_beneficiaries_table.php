<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {

        
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id');
            $table->string('nombres_apellidos',200);
            $table->string('dni',8);
            $table->string('celular',9);
            $table->string('email',50);
            $table->string('parentesco',50);
            $table->date('fecha_de_ingreso');

            //Asignar a la llave creada, la relacion la tabla beneficiarios
            $table->foreign('partner_id')->references('id')->on('partners');

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
        Schema::dropIfExists('beneficiaries');
    }
}

