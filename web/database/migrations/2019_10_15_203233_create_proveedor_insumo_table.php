<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorInsumoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_insumo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_proveedor');
            $table->bigInteger('telefono');
            $table->integer('idinsumo')->unsigned();
            $table->foreign('idinsumo')->references('id')->on('insumos');
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
        Schema::dropIfExists('proveedor_insumo');
    }
}
