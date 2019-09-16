<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Proyecto;

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
      echo $profesor['idUsuario'];
      echo "Tiene ";
      $count = Proyecto::where('idProfesor', $profesor['idUsuario'])->count();
      $profesor["Proyectos"] = $count;
      echo $count;
      echo "</br>";
    }
    return view('admin.asignarProyectos', compact('profesores'));
  }

  public function asignarProyectos(){

  }

  public function asignarProyectosManual($id){
    return view('admin.asignarProyectosManual')
  }
}
