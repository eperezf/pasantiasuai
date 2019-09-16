<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Pasantia;
use App\Empresa;
use App\User;
use App\EvalTutor;
use Auth;

class ProfesorController extends Controller
{
  public function index(){
    $proyectos = Proyecto::where('idProfesor', Auth::id())->get();
    foreach ($proyectos as $proyecto) {
      $pasantia = Pasantia::find($proyecto->idPasantia);
      $alumno = User::find($pasantia->idAlumno);
      $empresa = Empresa::find($pasantia->idEmpresa);
      $proyecto->alumno = $alumno;
      $proyecto->pasantia = $pasantia;
      $proyecto->empresa = $empresa;
    }
    return view('profesor.index', compact('proyectos'));
  }

  public function verProyecto($id){
    $proyecto = Proyecto::find($id);
    $pasantia = Pasantia::find($proyecto->idPasantia);
    $alumno = User::find($pasantia->idAlumno)->first();
    return view('profesor.proyecto', compact('proyecto'), compact('alumno'));
  }
}
