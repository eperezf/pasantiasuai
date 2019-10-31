<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->bigInteger('cantidad');
            $table->bigInteger('fecha_reposicion');
            $table->bigInteger('ancho');
            $table->bigInteger('alto');
            $table->bigInteger('largo');
            $table->string('sistema de unidades');
            $table->integer('idfondo')->unsigned();
            $table->foreign('idfondo')->references('id')->on('fondo');
            $table->integer('idproveedorinsumo')->unsigned();
            $table->foreign('idproveedorinsumo')->references('id')->on('ProveedorInsumo');

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
        Schema::dropIfExists('insumos');
    }
}
