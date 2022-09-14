<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuysServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys_services', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_services',10);
            $table->unsignedBigInteger('id_providers',10);
            $table->date('fecha_compra');
            $table->integer('cantidad');
            $table->double('valor_unitario');
            $table->double('valor_total');
            $table->string('boletaFactura', 7);
            $table->string('n_comprobante', 20);
            $table->string('estado', 10);

            $table->foreign('id_services')->references('id')->on('services');
            $table->foreign('id_providers')->references('id')->on('providers');

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
        Schema::dropIfExists('buys_services');
    }
}
