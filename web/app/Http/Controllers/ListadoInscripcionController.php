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
    $downloadExcel = FALSE;
    $datosPasantias = $this->getDatosPasantias();
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
    $datosPasantias = $this->getDatosPasantias();
    return Excel::download(new ExportViews('admin.tablaInscripciones', [ 
      'downloadExcel' => $downloadExcel,
      'datosPasantias' => $datosPasantias,
      ]), 'Inscripciones.xlsx');
  }
  /*
  * Saca los datos de cada pasantia
  */
  public function getDatosPasantias() {
    //Saca todas las pasantias
    $pasantias = Pasantia::all();
    //Definicion de arreglo a contener datos
    $datosPasantias = [];
    //Iterar sobre cada pasantia
    foreach ($pasantias as $pasantia) {
      //Sacar datos de cada pasantia
      $proyecto = Proyecto::where('idPasantia', $pasantia->idPasantia)->first();
      $empresas = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
      $usuarios = User::where('idUsuario', $pasantia->idAlumno)->first();
      $authUsers = AuthUsers::where('email', $usuarios->email)->first();

      if ($proyecto == null) {
        $proyecto = (object) [
          'idProyecto' => null,
          'status' => 0,
          'nombre' => 'Sin Nombre',
        ];
      }
      if ($empresas == null) {
        $empresas = (object) [
          'idEmpresa' => null,
          'nombreEmpresa' => 'No se ha seleccionado empresa',
          'rubroEmpresa' => 'No se ha seleccionado empresa',
          'urlWebEmpresa' => 'No se ha seleccionado empresa',
          'correoContactoEmpresa' => 'No se ha seleccionado empresa',
          'statusEmpresa' => 'No se ha seleccionado empresa',
        ];
      }

      /*
      $proyecto = new stdClass();
      $proyecto->idProyecto = null;
      $proyecto->status = 0;
      $proyecto->nombre = 'Sin Nombre';
      */


      //nombre de valor -> atributoTabla
      //Cada $datos[i] contiene un arreglo con los datos de la pasantia i
      array_push($datosPasantias, array(
        //Atributos Pasantia
        'idPasantia' => $pasantia->idPasantia,
        'fechaInicioPasantia' => $pasantia->fechaInicio,
        'nombreJefePasantia' => $pasantia->nombreJefe,
        'correoJefePasantia' => $pasantia->correoJefe,
        'lecReglamentoPasantia' => $pasantia->lecReglamento,
        'practicaOpPasantia' => $pasantia->practicaOp,
        'ciudadPasantia' => $pasantia->ciudad,
        'paisPasantia' => $pasantia->pais,
        'horasSemanalesPasantia' => $pasantia->horasSemanales,
        'parienteEmpresaPasantia' => $pasantia->parienteEmpresa,
        'rolParientePasantia' => $pasantia->rolPariente,
        'statusGeneralPasantia' => $pasantia->statusGeneral, 
        'statusPaso0Pasantia' => $pasantia->statusPaso0,
        'statusPaso1Pasantia' => $pasantia->statusPaso1, 
        'statusPaso2Pasantia' => $pasantia->statusPaso2, 
        'statusPaso3Pasantia' => $pasantia->statusPaso3,
        'statusPaso4Pasantia' => $pasantia->statusPaso4,
        //Atributos Proyecto
        'idProyecto' => $proyecto->idProyecto,
        'statusProyecto' => $proyecto->status,
        'nombreProyecto' => $proyecto->nombre,
        //Atributos Empresa
        'idEmpresa' => $empresas->idEmpresa,
        'nombreEmpresa' => $empresas->nombre,
        'rubroEmpresa' => $empresas->rubro,
        'urlWebEmpresa' => $empresas->urlWeb,
        'correoContactoEmpresa' => $empresas->correoContacto,
        'statusEmpresa' => $empresas->status,
        //Atributos Usuarios
        'idUsuario' => $usuarios->idUsuario,
        'nombresUsuario' => $usuarios->nombres,
        'apellidoPaternoUsuario' => $usuarios->apellidoPaterno,
        'apellidoMaternoUsuario' => $usuarios->apellidoMaterno,
        'idCarreraUsuario' => $usuarios->idCarrera,
        'statusPregradoUsuario' => $usuarios->statusPregrado,
        'rutUsuario' => $usuarios->rut,
        'emailUsuario' => $usuarios->email,
        //Atributos AuthUsers
        'tipoMallaAuth' => $authUsers->tipoMalla,
      ));
    }
    return $datosPasantias;
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
      if ($pasantia->statusPaso3 != 2) {
        $pasantia->statusPaso3 = 2;
      }    
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
