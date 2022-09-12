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

            $table->string('id_services',50);
            $table->string('id_providers',50);
            $table->date('fecha_compra');
            $table->integer('cantidad');
            $table->double('valor_unitario');
            $table->double('valor_total');
            $table->string('boletaFactura', 7);
            $table->string('n_comprobante', 20);
            $table->string('estado');

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
