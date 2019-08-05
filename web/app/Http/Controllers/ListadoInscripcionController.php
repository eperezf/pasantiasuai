<?php

namespace App\Http\Controllers;

use App\Exports\ExportViews;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Pasantia;
use App\Empresa;
use App\Proyecto;
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
    $usuarios = User::all();
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
  * Sacar todos los datos de las pasantias y su usuario respectivo
  */
  public function getAllUserData() {
    $authUsers = AuthUsers::all();
    $pasantias = Pasantia::all();
    $proyectos = Proyecto::all();
    $empresas = Empresa::all();
    $usuarios = User::all();
    /*
        DATOS NECESITADOS
      Pasantia
        'fechaInicio',
        'nombreJefe',
        'correoJefe',
        'lecReglamento',
        'practicaOp',
        'ciudad',
        'pais',
        'horasSemanales',
        'parienteEmpresa',
        'rolPariente'
        'statusGeneral' 
        'statusPaso0' 
        'statusPaso1' 
        'statusPaso2' 
        'statusPaso3' 
        'statusPaso4' 

      Proyecto
        'status'
        'nombre'

      Empresa
		    'nombre'
		    'rubro'
		    'urlWeb'
		    'correoContacto'
        'status'
        
      Usuario
        'nombres'
			  'apellidoPaterno'
			  'apellidoMaterno'
			  'idCarrera'
			  'statusPregrado'
			  'rut'
        'email'
        
      AuthUser
        'tipoMalla'
      

    */
    $datos = [];

    //Loop pasantias
    foreach ($pasantias as $pasantia) {
      //Loop saca proyecto de la pasantia i
      foreach ($proyectos as $proyecto) {
        $pasantia->$proyecto->first();
      }
      //Loop saca empresa de la pasantia i
      foreach ($empresas as $empresa) {
        $empresa = $pasantia->$empresa->first();
      }
      //Loop saca usuario de la pasantia i
      foreach ($usuarios as $usuario) {
        $usuario = $pasantia->$usuario->first();
        //Loop saca authUser del usuario i
        foreach ($authUsers as $authUser) {
          if ($usuario->email == $authUser->email){
            $authUser = $authUser->tipoMalla;
          }
        }
      }
      array_push($datos, 
              $pasantia->fechaInicio,
              $pasantia->nombreJefe,
              $pasantia->correoJefe,
              $pasantia->lecReglamento,
              $pasantia->practicaOp,
              $pasantia->ciudad,
              $pasantia->pais,
              $pasantia->horasSemanales,
              $pasantia->parienteEmpresa,
              $pasantia->rolPariente,
              $pasantia->statusGeneral ,
              $pasantia->statusPaso0, 
              $pasantia->statusPaso1, 
              $pasantia->statusPaso2, 
              $pasantia->statusPaso3, 
              $pasantia->statusPaso4,

              $proyecto->status,
              $proyecto->nombre,

              $empresa->nombre,
              $empresa->rubro,
              $empresa->urlWeb,
              $empresa->correoContacto,
              $empresa->status,

              $usuario->nombres,
              $usuario->apellidoPaterno,
              $usuario->apellidoMaterno,
              $usuario->idCarrera,
              $usuario->statusPregrado,
              $usuario->rut,
              $usuario->email,
 
              $authUser->tipoMalla);
    }
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
      // Estado Empresa
      if ($empresa->status != 1) {
        $empresa->status = 1;
      }
      /*
      if ($pasantia->statusPaso0 != 2) {
        $pasantia->statusPaso2 = 2;
      }
      if ($pasantia->statusPaso1 != 2) {
        $pasantia->statusPaso2 = 2;
      }
      */
      // Estado Familiar (si es que tiene)
      if ($pasantia->statusPaso2 != 2) {
      $pasantia->statusPaso2 = 2;
      }
      // Estado Mail
      /*
      if ($pasantia->statusPaso3 != 2) {
        $pasantia->statusPaso2 = 2;
      }
      // Estado Proyecto
      if ($pasantia->statusPaso4 != 2) {
        $pasantia->statusPaso2 = 2;
      }
      */
      // Estado de la pasantia (si la puede ejercer)
      if ($pasantia->statusGeneral != 1) {
        $pasantia->statusGeneral = 1;
      }
      $empresa->save();
      $pasantia->save();
      return redirect('admin/listadoInscripcion')->with('success', 'La pasantía ha sido validada exitosamente.');
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
