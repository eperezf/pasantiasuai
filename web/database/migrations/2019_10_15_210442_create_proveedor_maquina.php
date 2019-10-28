<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorMaquina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_maquina', function (Blueprint $table) {
            $table->bigIncrements('idproveedor_maquina');
            $table->string('nombre_proveedor';100);
            $table->integer('telefono';50);
            $table->bigInteger('idmaquinas')->unsigned();
            $table->foreing('idmaquinas')->references('idproveedor_maquina')->on('maquinas');
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
        Schema::dropIfExists('proveedor_maquina');
    }
}
