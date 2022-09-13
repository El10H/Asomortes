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

            $table->string('id_partners',50);
            $table->string('id_beneficiaries',50);
            $table->date('fecha_entrega');
            $table->string('tipo_beneficio', 30);
            $table->string('estado', 18);

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
