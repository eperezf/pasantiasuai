<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\AuthUsers;
use App\Pasantia;
use App\Empresa;
use App\User;


class IndexController extends Controller
{
  //
  public function index() {
    $userId = Auth::id();
    $pasantia = Pasantia::where('idAlumno', $userId)->first();
    $empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
    $datos = $this->getResumenes();
    return view('index', compact('pasantia', 'empresa', 'datos'));
  }

  public function getResumenes() {
    //Datos Pasantias
    $pasantiasTotal = Pasantia::all()->count();
    $pasantiasSantiago = Pasantia::where('ciudad', '=', 'Santiago')->count();
    $pasantiasValidas = Pasantia::where('statusPaso4', '=', '2')->count();
    
    //Datos Usuarios
    $usuariosPasantes = User::where('rol', '=', '1')->count();
    $usuariosProfesores = User::where('rol', '=', '2')->count();
    $usuariosAdmin = User::where('rol', '>=', '4')->count();

    //Datos Empresas
    $empresasValidadas = Empresa::where('status', '=', '1')->count();
    $empresasNoValidadas = Empresa::where('status', '=', '0')->count();
    $empresasTotal = $empresasValidadas + $empresasNoValidadas;

    //Array de datos
    $myArray = array(
      array("one", "two", "three"),
      array("four", "five", "six")
    );
    $datos = [
      ['pasantias' => ['santiago' => $pasantiasSantiago, 
                      'validas' => $pasantiasValidas, 
                      'total' => $pasantiasTotal]],
      ['usuarios' => ['pasantes' => $usuariosPasantes, 
                      'profesores' => $usuariosProfesores, 
                      'admin' => $usuariosAdmin]],
      ['empresas' => ['validas' => $empresasValidadas, 
                      'noValidas' => $empresasNoValidadas, 
                      'total' => $empresasTotal]]
    ];
    return $datos;
  }
}
