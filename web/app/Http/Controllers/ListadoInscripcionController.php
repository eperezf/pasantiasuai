<?php

namespace App\Http\Controllers;

use App\Exports\ExportViews;
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
    $downloadExcel = FALSE;
    return view('admin.listadoInscripcion', [
      'usuarios' => $usuarios, 
      'pasantias' => $pasantias, 
      'empresas' => $empresas, 
      'downloadExcel' => $downloadExcel
    ]);
  }

  /*
  * Permite la exportacion de los datos hacia excel
  */
  public function export() {
    $usuarios =  User::all();
    $pasantias = Pasantia::all();
    $empresas = Empresa::all();
    $downloadExcel = TRUE;
    return Excel::download(new ExportViews('admin.tablaInscripciones', [
      'usuarios' => $usuarios, 
      'pasantias' => $pasantias, 
      'empresas' => $empresas, 
      'downloadExcel' => $downloadExcel
      ]), 'Inscripciones.xlsx');
  }

  /*
  * Acceso rapido para que administrador valide la pasantia
  */
  // parienteEmpresa = 2 -> pariente validado
  public function validarPariente($id, $statusPaso2) {
    if (Auth::user()->rol >= 4) {
      $pasantia = Pasantia::find($id);
      if ($statusPaso2 != 2) {
        $pasantia->statusPaso2 = 2;
        $pasantia->save();
        return redirect('admin/listadoInscripcion')->with('success', 'Pariente ' . $pasantia->rolPariente . ' validado exitosamente');
      }
      elseif ($statusPaso2 == 2) {
        $pasantia->statusPaso2 = 3;
        $pasantia->save();
        return redirect('admin/listadoInscripcion')->with('success', 'Pariente ' . $pasantia->rolPariente . ' invalidado exitosamente');
      } else {
        return redirect('admin/listadoInscripcion');
      }
    } else {
      return redirect('index');
    }
  }

  // empresa = 1 -> convenio activo
  public function validarEmpresa($id, $statusEmpresa){
    if (Auth::user()->rol >= 4) {
      $empresa = Empresa::find($id);
      if ($statusEmpresa == 1) {
        $empresa->status = 0;
        $empresa->save();
        return redirect('admin/listadoInscripcion')->with('success', 'Convenio con empresa ' . $empresa->nombre . ' desactivado exitosamente');
      }
      elseif ($statusEmpresa == 0) {
        $empresa->status = 1;
        $empresa->save();
        return redirect('admin/listadoInscripcion')->with('success', 'Convenio con empresa ' . $empresa->nombre . ' activado exitosamente');
      } else {
        return redirect('admin/listadoInscripcion');
      }
    } else {
      return redirect('index');
    }
  }

  public function validarTodo($idEmpresa, $idPasantia) {
    if (Auth::user()->rol >= 4) {
      $empresa = Empresa::find($idEmpresa);
      $pasantia = Pasantia::find($idPasantia);
      if ($empresa->status != 1) {
        $empresa->status = 1;
        $empresa->save();
      }
      if ($pasantia->statusPaso2 != 2) {
      $pasantia->statusPaso2 = 2;
      $pasantia->save();
      }
      return redirect('admin/listadoInscripcion')->with('success', 'Pasantía ha sido validada exitosamente.');
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
