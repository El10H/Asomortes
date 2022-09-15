<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_benefit_deliveries');
            $table->String('sku_option_products',10);

            $table->foreign('id_benefit_deliveries')->references('id')->on('benefit_deliveries');
            //$table->foreign('sku_option_products')->references('id')->on('option_products');

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
        Schema::dropIfExists('benefit_products');
    }
}
