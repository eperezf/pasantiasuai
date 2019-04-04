<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model{
	protected $table = 'empresa';
	protected $primaryKey = 'idEmpresa';

  protected $fillable = [
		'nombre',
		'rubro',
		'urlWeb',
		'correoContacto',
		'status'
	];
}
