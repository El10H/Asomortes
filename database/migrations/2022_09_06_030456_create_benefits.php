<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_benefit_deliveries',10);
            $table->String('sku_option_products',10);
            $table->unsignedBigInteger('id_option_services',10);
            $table->double('efectivo');

            $table->foreign('id_benefit_deliveries')->references('id')->on('benefit_deliveries');
            //$table->foreign('sku_option_products')->references('id')->on('option_products');
            $table->foreign('id_option_services')->references('id')->on('option_services');

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
        Schema::dropIfExists('benefits');
    }
}
