<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasantiaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pasantia';

    /**
     * Run the migrations.
     * @table Pasantia
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idPasantia');
            $table->integer('idAlumno')->unsigned();
            $table->integer('idProfesor')->unsigned();
            $table->date('fechaInicio');
            $table->date('fechaTermino');
            $table->tinyInteger('Modalidad');
            $table->integer('Status');
            $table->integer('idEmpresa')->unsigned();
            $table->string('nombreJefe', 45);
            $table->string('correoJefe', 45);
            $table->tinyInteger('lecReglamento');
            $table->tinyInteger('practicaOp');
            $table->string('ciudad', 45);
            $table->string('pais', 45);
            $table->integer('horasSemanales');
            $table->tinyInteger('parienteEmpresa');
						$table->timestamps();

            $table->index("idEmpresa");

            $table->index("idAlumno");

            $table->index("idProfesor");

            $table->unique("idPasantia");


            $table->foreign('idAlumno')
                ->references('idUsuario')->on('users');

            $table->foreign('idProfesor')
                ->references('idUsuario')->on('users');

            $table->foreign('idEmpresa')
                ->references('idEmpresa')->on('empresa');
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
