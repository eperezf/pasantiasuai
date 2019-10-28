<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinaMantencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquina_mantencion', function (Blueprint $table) {
            $table->bigIncrements('idmantencion');
            $table->date('fecha_mantencion';100);
            $table->date('prox_fecha_mantencion';100);
            $table->string('nombre_realiza_mantencion';100);
            $table->string('descripcion_mantenimiento';400);
            $table->integer('costo_mantenimiento';400);
            $table->integer('costo_repuestos';400);
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
        Schema::dropIfExists('maquina_mantencion');
    }
}
