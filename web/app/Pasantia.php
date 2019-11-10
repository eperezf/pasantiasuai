<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasantia extends Model{
	protected $table = 'pasantia';
	protected $primaryKey = 'idPasantia';

	protected $fillable = [
		'idAlumno',
		'fechaInicio',
		'idEmpresa',
		'nombreJefe',
		'correoJefe',
		'tokenCorreo',
		'lecReglamento',
		'practicaOp',
		'ciudad',
		'pais',
		'horasSemanales',
		'parienteEmpresa',
		'rolPariente'
	];

	public function empresa(){
    return $this->hasOne('App\Empresa', 'idEmpresa', 'idEmpresa');
	}
	public function alumno(){
	  return $this->belongsTo('App\User', 'idAlumno', 'idUsuario');
	}
}
