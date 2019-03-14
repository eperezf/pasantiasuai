<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Empresa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idEmpresa');
            $table->string('nombre', 45);
            $table->string('Rubro', 45);
            $table->string('urlWeb', 45);
            $table->string('correoContacto', 45);

            $table->unique(["idEmpresa"], 'idEmpresa_UNIQUE');

            $table->unique(["urlWeb"], 'urlWeb_UNIQUE');

            $table->unique(["nombre"], 'nombre_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Empresa');
    }
}
