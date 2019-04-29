<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evalTutor', function (Blueprint $table) {
            $table->bigIncrements('idEvalTutor');
						$table->unsignedInteger('idPasantia');
            $table->unsignedInteger('compromiso');
            $table->unsignedInteger('adaptabilidad');
            $table->unsignedInteger('comunicacion');
            $table->unsignedInteger('equipo');
            $table->unsignedInteger('liderazgo');
            $table->unsignedInteger('sobreponerse');
            $table->unsignedInteger('habilidades');
            $table->unsignedInteger('proactividad');
            $table->unsignedInteger('innovacion');
            $table->unsignedInteger('etica');
            $table->float('promedio');
            $table->string('comentarios')->nullable();
            $table->unsignedTinyInteger('certificadoTutor');
						$table->timestamps();

            $table->unique(["idEncuesta"], 'idEncuesta_UNIQUE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_tutor');
    }
}
