<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanctionedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanctioneds', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('partner_id');
            $table->date('fecha_pago');
            $table->date('fecha_habilitacion');

            $table->foreign('partner_id')->references('id')->on('partners');
            
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
        Schema::dropIfExists('sanctioneds');
    }
}
