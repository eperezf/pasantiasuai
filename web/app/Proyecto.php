<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model{
  protected $table = 'proyecto';
	protected $primaryKey = 'idProyecto';

  protected $fillable = [
    'idProyecto',
    'idPasantia',
    'idProfesor',
    'status',
    'nombre',
    'area',
    'disciplina',
    'problematica',
    'objetivo',
    'medidas',
    'metodologia',
    'planificacion',
    'comentario'
	];
}
