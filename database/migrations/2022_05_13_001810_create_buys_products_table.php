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

            $table->string('id_products',50);
            $table->string('id_providers',50);
            $table->string('boletaFactura', 7);
            $table->string('n_comprobante', 20);
            $table->date('fecha_compra');
            $table->double('valor_total');
            $table->integer('total_articulos');
            $table->string('descripcion');
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
        Schema::dropIfExists('buys_products');
    }
}
