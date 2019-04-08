<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasantia extends Model{
	protected $table = 'pasantia';
	protected $primaryKey = 'idPasantia';

	protected $fillable = [
		'idAlumno',
		'idProfesor',
		'fechaInicio',
		'idEmpresa',
		'nombreJefe',
		'correoJefe',
		'lecReglamento',
		'practicaOp',
		'ciudad',
		'pais',
		'horasSemanales',
		'parienteEmpresa',
	]
}
