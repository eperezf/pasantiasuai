<?php

namespace App\Http\Controllers;

use App\Exports\InscripcionesExports;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Pasantia;
use App\Empresa;
use App\AuthUsers;
use Auth;
use Illuminate\Http\Request;

/**
 * ListadoInscripcionController es el controlador del listado de pasantias.
 * En este controlador están las funciones para mostrar, editar, actualizar y eliminar las pasantias.
 */

class ListadoInscripcionController extends Controller
{
  /*
  * Muestra el listado de las pasantias
  */
  public function index() {
    $usuarios =  User::all();
    $pasantias = Pasantia::all();
    $empresas = Empresa::all();
    return view('admin.listadoInscripcion', compact('usuarios', 'pasantias', 'empresas'));
  }

  /*
  * Permite la exportacion de los datos hacia excel
  */
  public function export() {
    return Excel::download(new InscripcionesExports, 'Inscripciones.xlsx', null, ['RUT', 'Nombre alumno']);
  }

  /*
  * Acceso rapido para que administrador valide la pasantia
  */
  public function validarPasantia($id) {
    if (Auth::user()->rol >= 4) {
      $pasantia = Pasantia::find($id);
      return view('admin/listadoInscripcion', compact('pasantia'));
    } else {
      return redirect('index');
    }
  }
  /*
  * Permite editar la pasantia seleccionada por el administrador
  */
  public function edit($id) {
    if (Auth::user()->rol >= 4) {
      $pasantia = Pasantia::find($id);
      return view('admin/editInscripcion', compact('pasantia'));
    } else {
      return redirect('index');
    }
  }

  /*
  * Actualiza la pasantia respecto a los datos editados en el formulario de edit
  */
  public function update(Request $request, $id) {
    if (Auth::user()->rol >= 4) {

    } else {
      return redirect('index');
    }

  }

  /*
  * Elimina la pasantia seleccionada por el administrador
  */
  public function destroy($id) {
      if (Auth::user()->rol >= 4) {
        $pasantia = Pasantia::find($id);
        $pasantia->delete();
        return redirect('admin/listadoInscripcion')->with('success', 'Pasantía eliminada exitosamente');
      } else {
        return redirect('index');
      }
    }

}
