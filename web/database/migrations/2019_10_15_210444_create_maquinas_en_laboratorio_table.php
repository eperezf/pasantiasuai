<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinasEnLaboratorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinas_en_laboratorio', function (Blueprint $table) {
            $table->bigIncrements('idmaquinaslab');
            $table->bigInteger('idlab')->unsigned();
            $table->foreign('idlab')->references('idmaquinaslab')->on('laboratorio');
            $table->bigInteger('idmaquinas')->unsigned();
            $table->foreign('idmaquinas')->references('idmaquinaslab')->on('maquinas');
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
        Schema::dropIfExists('maquinas_en_laboratorio');
    }
}
