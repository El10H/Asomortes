<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuysProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_products',10);
            $table->unsignedBigInteger('id_providers',10);
            $table->string('boletaFactura', 7);
            $table->string('n_comprobante', 20);
            $table->date('fecha_compra');
            $table->double('valor_total');
            $table->integer('total_articulos');
            $table->string('descripcion');
            $table->string('estado', 10);

            $table->foreign('id_products')->references('id')->on('products');
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
        Schema::dropIfExists('buys_products');
    }
}
