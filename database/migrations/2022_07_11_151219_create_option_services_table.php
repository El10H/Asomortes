<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_services', function (Blueprint $table) {
            $table->bigIncrements('id');

            //Datos del servicio
            $table->unsignedBigInteger('id_services',10);
            $table->string('nombre',50);
            $table->double('valor');
            $table->double('stock');
            $table->string('descripcion', 200);

            $table->foreign('id_services')->references('id')->on('services');

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
        Schema::dropIfExists('option_services');
    }
}
