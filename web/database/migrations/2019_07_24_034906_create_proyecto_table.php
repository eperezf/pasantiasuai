<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'proyecto';

    /**
     * Run the migrations.
     * @table proyecto
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idProyecto');
            $table->unsignedInteger('idPasantia');
            $table->unsignedInteger('status');
            $table->unsignedInteger('idProfesor')->nullable()->default(null);
            $table->string('nombre', 45)->nullable()->default(null);
            $table->string('area', 45)->nullable()->default(null);
            $table->string('disciplina', 45)->nullable()->default(null);
            $table->string('problematica', 45)->nullable()->default(null);
            $table->string('objetivo', 45)->nullable()->default(null);
            $table->string('medidas', 45)->nullable()->default(null);
            $table->string('metodologia', 45)->nullable()->default(null);
            $table->string('planificacion', 45)->nullable()->default(null);
            $table->timestamps();


            $table->index(["idProfesor"], 'idProfesor_idx');

            $table->index(["idPasantia"], 'idPasantia_idx');


            $table->foreign('idPasantia')
                ->references('idPasantia')->on('pasantia');

            $table->foreign('idProfesor')
                ->references('idUsuario')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
