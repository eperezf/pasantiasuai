<?php

namespace App\Http\Controllers;

use App\Exports\ExportViews;
use App\Repositories\PasantiasRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Pasantia;
use App\Empresa;
use App\Proyecto;
use App\AuthUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
    $downloadExcel = FALSE;
    $datosPasantias = PasantiasRepository::getAllPasantias();
    return view('admin.listadoInscripcion', [ 
      'downloadExcel' => $downloadExcel,
      'datosPasantias' => $datosPasantias,
    ]);
  }

  /*
  * Permite la exportacion de los datos hacia excel
  */
  public function export() {
    $downloadExcel = TRUE;
    $datosPasantias = PasantiasRepository::getAllPasantias();
    return Excel::download(new ExportViews('admin.tablaInscripciones', [ 
      'downloadExcel' => $downloadExcel,
      'datosPasantias' => $datosPasantias,
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

  public function validarProyecto($id, $accion)
  {
    if (Auth::user()->rol >= 4) {
      $pasantia = Pasantia::find($id);
      if ($accion == 'Validar') {
        $pasantia->statusPaso4 = 3;
      }
      elseif ($accion == 'Rechazar') {
        $pasantia->statusPaso4 = 4;
      }
      $pasantia->save();
      return redirect('admin/listadoInscripcion')->with('success', 'Operacion realizada correctamente.');
    } else {
      return redirect('admin/listadoInscripcion');
    }
  }

  /* 
    Validar todo valida paso 2 y paso general
  */
  public function validarTodo($nombresUsuario, $idPasantia) {
    if (Auth::user()->rol >= 4) {
      $pasantia = Pasantia::find($idPasantia);
      // Estado Familiar (si es que tiene)
      if ($pasantia->statusPaso2 != 2) {
      $pasantia->statusPaso2 = 2;
      }  
      // Estado de la pasantia (si la puede ejercer)
      if ($pasantia->statusGeneral != 1) {
        $pasantia->statusGeneral = 1;
      }
      $pasantia->save();
      return redirect('admin/listadoInscripcion')->with('success', 'La pasantía de '. $nombresUsuario . ' ha sido validada exitosamente.');
    } else {
      return redirect('index');
    }
  }
  /*
  * Permite editar la pasantia seleccionada por el administrador
  */
  public function edit($id) {
    if (Auth::user()->rol >= 4) {
      $empresas = Empresa::all();
      $datosPasantias = PasantiasRepository::getPasantia($id);
      return view('admin.editInscripcion', ['datosPasantias' => $datosPasantias, 'empresas' => $empresas]);
    } else {
      return redirect('index');
    }
  }
  /*
  * Actualiza la pasantia respecto a los datos editados en el formulario de edit
  */

  //Actualiza paso 2
  public function updatePaso2(Request $request, $id) {
    if (Auth::user()->rol >= 4) {
      $request->validate([
        'empresa' => 'numeric|required',
        'ciudad' => 'alpha|required',
        'pais' => 'alpha|required',
        'fecha' => 'date|required',
        'horas' => 'numeric|between:20,45|required',
        'pariente' => 'boolean|required',
        'rolPariente' => 'required_if:pariente,1'
      ]);
      $pasantia = Pasantia::find($id);
      $pasantia->idEmpresa = $request->empresa;
      $pasantia->ciudad = $request->ciudad;
      $pasantia->pais = $request->pais;
      $pasantia->fechaInicio = $request->fecha;
      $pasantia->horasSemanales = $request->horas;
      $pasantia->parienteEmpresa = $request->pariente;
      $pasantia->rolPariente = $request->rolPariente;
      $pasantia->save();
      return redirect('admin/listadoInscripcion/'. $id . '/edit')->with('success', 'Paso 2 editado exitosamente');
    } else {
      return redirect('index');
    }
  }

  //Actualiza paso 3
  public function updatePaso3(Request $request, $id) {
    if (Auth::user()->rol >= 4) {
      $request->validate([
        'nombre' => 'alpha|required',
        'email' => 'email:rfc,dns|required'
      ]);
      $pasantia = Pasantia::find($id);
      $pasantia->nombreJefe = $request->nombre;
		  $pasantia->correoJefe = $request->email;
      $pasantia->save();
      return redirect('admin/listadoInscripcion/'. $id . '/edit')->with('success', 'Paso 3 editado exitosamente');
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
