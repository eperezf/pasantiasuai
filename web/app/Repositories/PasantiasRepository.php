<?php

namespace App\Repositories;

use App\User;
use App\Pasantia;
use App\Empresa;
use App\Proyecto;

class PasantiasRepository
{

  //Arreglo que contendra los datos de la pasantia
  private static $datosPasantias = [];

  //Traductor de pasos a texto
  public function traductorPasos($pasantia)
  {
    /*
    PASO 0
      statusPaso0Pasantia == 2 Reglamento aceptado
      statusPaso0Pasantia != 2 Reglamento aún no aceptado
    */
    if ($pasantia->statusPaso0 == 2) {
      $pasantia->statusPaso0 = 'Reglamento aceptado';
    } elseif ($pasantia->statusPaso0 != 2) {
      $pasantia->statusPaso0 = 'Reglamento aún no aceptado';
    }

    /*
    PASO 1
      statusPaso1Pasantia == 2 Cumple requerimientos académicos
			statusPaso1Pasantia != 2 No cumple todos los requerimientos académicos
    */
    if ($pasantia->statusPaso1 == 2) {
      $pasantia->statusPaso1 = 'Cumple requerimientos académicos';
    } elseif ($pasantia->statusPaso1 != 2) {
      $pasantia->statusPaso1 = 'No cumple todos los requerimientos académicos';
    }

    /*
    PASO 2
      statusPaso2Pasantia == 1 Datos incompletos
			statusPaso2Pasantia == 2 Completado y validado
			statusPaso2Pasantia == 3 Pendiente por pariente
      else No ha iniciado el paso 2
    */
    if ($pasantia->statusPaso2 == 1) {
      $pasantia->statusPaso2 = 'Datos incompletos';
    } elseif ($pasantia->statusPaso2 == 2) {
      $pasantia->statusPaso2 = 'Completado y validado';
    } elseif ($pasantia->statusPaso2 == 3) {
      $pasantia->statusPaso2 = 'Pendiente por pariente';
    } else {
      $pasantia->statusPaso2 = 'No ha iniciado el paso 2';
    }

    /*
    PASO 3
      statusPaso3Pasantia == 0 No realizado
			statusPaso3Pasantia == 1 Datos incompletos
			statusPaso3Pasantia == 2 Correo no enviado
			statusPaso3Pasantia == 3 Correo no confirmado
      statusPaso3Pasantia == 4 Correo confirmado
    */
    if ($pasantia->statusPaso3 == 0) {
      $pasantia->statusPaso3 = 'No realizado';
    } elseif ($pasantia->statusPaso3 == 1) {
      $pasantia->statusPaso3 = 'Datos incompletos';
    } elseif ($pasantia->statusPaso3 == 2) {
      $pasantia->statusPaso3 = 'Correo no enviado';
    } elseif ($pasantia->statusPaso3 == 3) {
      $pasantia->statusPaso3 = 'Correo no confirmado';
    } elseif ($pasantia->statusPaso3 == 4) {
      $pasantia->statusPaso3 = 'Correo confirmado';
    }

    /*
    PASO 4
      statusPaso4Pasantia == 0 No realizado
			statusPaso4Pasantia == 1 Datos incompletos
			statusPaso4Pasantia == 2 No validado
			statusPaso4Pasantia == 3 Validado
      statusPaso4Pasantia == 4 Rechazado
    */
    if ($pasantia->statusPaso4 == 0) {
      $pasantia->statusPaso4 = 'No realizado';
    } elseif ($pasantia->statusPaso4 == 1) {
      $pasantia->statusPaso4 = 'Datos incompletos';
    } elseif ($pasantia->statusPaso4 == 2) {
      $pasantia->statusPaso4 = 'No validado';
    } elseif ($pasantia->statusPaso4 == 3) {
      $pasantia->statusPaso4 = 'Validado';
    } elseif ($pasantia->statusPaso4 == 4) {
      $pasantia->statusPaso4 = 'Rechazado';
    }

    /*
    STATUS GENERAL
      statusGeneralPasantia == 0 Pasantía sin validar
			statusGeneralPasantia == 1 Pasantia validada
    */
    if ($pasantia->statusGeneral == 0) {
      $pasantia->statusGeneral = 'Pasantía sin validar';
    } elseif ($pasantia->statusGeneral == 1) {
      $pasantia->statusGeneral = 'Pasantia validada';
    }

    return $pasantia;
  }

  //Datos asociados a la pasantia
  public function llenaDatosPasantias($pasantia, $proyecto, $empresas, $usuarios)
  {
    $pasantia = $this->traductorPasos($pasantia);

    $pasantiaDatos = array(
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
      'tipoMallaUsuario' => $usuarios->tipoMalla,
    );
    return $pasantiaDatos;
  }

  //Saca una unica pasantia y todos sus datos asociados
  public static function getPasantia($id)
  {
    $pasantia = Pasantia::where('idPasantia', $id)->first();
    $proyecto = Proyecto::where('idPasantia', $id)->first();
    $empresas = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
    $usuarios = User::where('idUsuario', $pasantia->idAlumno)->first();
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
        'nombre' => 'No se ha seleccionado empresa',
        'rubro' => 'No se ha seleccionado empresa',
        'urlWeb' => 'No se ha seleccionado empresa',
        'correoContacto' => 'No se ha seleccionado empresa',
        'status' => 'No se ha seleccionado empresa',
      ];
    }
    self::$datosPasantias = (new self)->llenaDatosPasantias($pasantia, $proyecto, $empresas, $usuarios);
    return self::$datosPasantias;
  }

  //Saca todas las pasantias y todos sus datos asociados
  public static function getAllPasantias()
  {
    $pasantias = Pasantia::all();
    foreach ($pasantias as $pasantia) {
      //Sacar datos de cada pasantia
      $proyecto = Proyecto::where('idPasantia', $pasantia->idPasantia)->first();
      $empresas = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
      $usuarios = User::where('idUsuario', $pasantia->idAlumno)->first();

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
          'nombre' => 'No se ha seleccionado empresa',
          'rubro' => 'No se ha seleccionado empresa',
          'urlWeb' => 'No se ha seleccionado empresa',
          'correoContacto' => 'No se ha seleccionado empresa',
          'status' => 'No se ha seleccionado empresa',
        ];
      }
      //nombre de valor -> atributoTabla
      //Cada $datos[i] contiene un arreglo con los datos de la pasantia i
      array_push(self::$datosPasantias, (new self)->llenaDatosPasantias($pasantia, $proyecto, $empresas, $usuarios));
    }
    return self::$datosPasantias;
  }
}
