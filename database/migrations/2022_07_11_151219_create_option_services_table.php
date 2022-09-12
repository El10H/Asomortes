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
            $table->string('id_services',50);
            $table->string('nombre',50);
            $table->double('valor');
            $table->double('stock');
            $table->string('descripcion', 200);

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
