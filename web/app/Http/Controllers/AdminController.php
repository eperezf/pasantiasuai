<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Proyecto;
use App\Pasantia;

class AdminController extends Controller
{
  public function index(){
  	return view('admin.index');
  }

  public function asignarProyectosView(){
    //Obtenemos listado de profesores en el sistema
    $profesores = User::where('rol', '3')->get();
    //Buscamos la cantidad de alumnos asignados al profesores
    foreach ($profesores as $profesor) {
      $count = Proyecto::where('idProfesor', $profesor['idUsuario'])->count();
      $profesor["Proyectos"] = $count;
    }
    return view('admin.asignarProyectos', compact('profesores'));
  }

  public function asignarProyectosExcel(){

  }

  public function asignarProyectosManual($id){
    $profesor = User::find($id);
    $proyectos = Proyecto::all();
    foreach ($proyectos as $proyecto) {
      $pasantia = Pasantia::find($proyecto->idPasantia);
      $alumno = User::find($pasantia->idAlumno);
      $proyecto->alumno = $alumno;
    }
    return view('admin.asignarProyectosManual', compact('profesor'), compact('proyectos'));
  }

  public function asignarProyectoQuick($idProf, $idProy, $action){
    if ($action == 'agregar') {
      $profesor = User::find($idProf);
      $proyecto = Proyecto::find($idProy);
      $proyecto->idProfesor = $profesor->idUsuario;
      $proyecto->save();
      return redirect()->back();
    }
    elseif ($action == 'eliminar') {
      $proyecto = Proyecto::find($idProy);
      $proyecto->idProfesor = null;
      $proyecto->save();
      return redirect()->back();
    }
  }
}
