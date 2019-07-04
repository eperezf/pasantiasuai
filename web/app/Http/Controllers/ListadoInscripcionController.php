<?php

namespace App\Http\Controllers;

use App\Exports\InscripcionesExports;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Pasantia;
use App\Empresa;
use App\AuthUsers;
use Illuminate\Http\Request;

class ListadoInscripcionController extends Controller
{
  public function index() {
    $usuarios =  User::all();
    $pasantias = Pasantia::all();
    $empresas = Empresa::all();
    return view('admin.listadoInscripcion', compact('usuarios', 'pasantias', 'empresas'));
  }

  public function export() {
    return Excel::download(new InscripcionesExports, 'Inscripciones.xlsx');
  }
}
