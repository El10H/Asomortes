<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_services', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_benefit_deliveries');
            $table->unsignedBigInteger('id_option_services');

            $table->foreign('id_benefit_deliveries')->references('id')->on('benefit_deliveries');
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
        Schema::dropIfExists('benefit_services');
    }
}
