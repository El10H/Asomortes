<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_partners');
            $table->unsignedBigInteger('id_beneficiaries');
            $table->date('fecha_entrega');
            $table->string('tipo_beneficio', 35);
            $table->string('estado', 20);

            $table->foreign('id_partners')->references('id')->on('partners');
            $table->foreign('id_beneficiaries')->references('id')->on('beneficiaries');

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
        Schema::dropIfExists('benefit_deliveries');
    }
}
