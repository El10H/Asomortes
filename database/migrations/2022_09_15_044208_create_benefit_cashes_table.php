<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_cashes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_benefit_deliveries');
            $table->double('efectivo');

            $table->foreign('id_benefit_deliveries')->references('id')->on('benefit_deliveries');

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
        Schema::dropIfExists('benefit_cashes');
    }
}
