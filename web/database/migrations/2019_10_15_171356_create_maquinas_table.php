<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinas', function (Blueprint $table) {
            $table->bigIncrements('idmaquinas');
            $table->string('nombre';100);
            $table->string('modelo',100);
            $table->string('marca',100);
            $table->string('descripcion',250);
            $table->date('año_adquisicion',100);
            $table->integer('precio_adquisicion',100);
            $table->integer('cantidad',100);
            $table->timestamps();
            $table->bigInteger('idmantencion')->unsigned();
            $table->foreing('idmantencion')->reference('idmaquinas')->on('maquina_mantencion');
            $table->bigInteger('idfondo')->unsigned();
            $table->foreing('idfondo')->reference('idmaquinas')->on('fondo');
            $table->bigInteger('idproveedor')->unsigned();
            $table->foreing('idproveedor')->reference('idmaquinas')->on('proveedor_maquina');





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maquinas');
    }
}
