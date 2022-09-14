<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_vouchers');
            $table->unsignedBigInteger('id_attribute_products');
            $table->integer('sku');
            //$table->string('nombre',50);
            $table->string('opcion',30);

            $table->foreign('id_vouchers')->references('id')->on('buys_products');

            $table->foreign('id_attribute_products')->references('id')->on('attribute_products');

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
        Schema::dropIfExists('option_products');
    }
}