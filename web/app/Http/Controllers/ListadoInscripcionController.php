<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Pasantia;
use App\Empresa;
use App\AuthUsers;
use Illuminate\Http\Request;

class ListadoInscripcionController extends Controller
{
  public function index()
  {
    $usuarios =  User::all();
    $pasantias = Pasantia::all();
    $empresas = Empresa::all();
    return view('admin.listadoInscripcion', compact('usuarios', 'pasantias', 'empresas'));
  }
}
