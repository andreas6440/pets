<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscripcionMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripcion_movimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suscripcion_id');
            $table->foreign('suscripcion_id')->references('id')->on('suscripcions')->onDelete('cascade');
            $table->string('tipo');
            $table->json('data');
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
        Schema::dropIfExists('suscripcion_movimientos');
    }
}