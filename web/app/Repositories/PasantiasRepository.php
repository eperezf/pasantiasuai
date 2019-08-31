<?php

namespace App\Repositories;

use App\User;
use App\Pasantia;
use App\Empresa;
use App\Proyecto;
use App\AuthUsers;

class PasantiasRepository{
  
  public static function getDatosPasantias()
  {
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
        'tipoMallaUsuario' => $usuarios->tipoMalla,
      ));
    }
    return $datosPasantias;
  }


}