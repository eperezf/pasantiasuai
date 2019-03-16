<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration{
	public function up(){
    Schema::create('Empresa', function (Blueprint $table) {
      $table->increments('idEmpresa');
      $table->string('nombre', 45);
      $table->string('Rubro', 45);
      $table->string('urlWeb', 45);
      $table->string('correoContacto', 45);
			$table->integer('status');
			$table->timestamps();

      $table->unique(["idEmpresa"], 'idEmpresa_UNIQUE');

      $table->unique(["urlWeb"], 'urlWeb_UNIQUE');

      $table->unique(["nombre"], 'nombre_UNIQUE');
    });
  }

  public function down(){
    Schema::dropIfExists('Empresa');
  }
}
