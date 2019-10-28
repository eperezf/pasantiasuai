<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosEnLaboratorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_en_laboratorio', function (Blueprint $table) {
            $table->bigIncrements('idinsumoslab');
            $table->bigInteger('idinsumos')->unsigned();
            $table->foreign('idinsumos')->references('idinsumoslab')->on('insumos');
            $table->bigInteger('idlab')->unsigned();
            $table->foreign('idlab')->references('idinsumoslab')->on('laboratorio');
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
        Schema::dropIfExists('insumos_en_laboratorio');
    }
}
