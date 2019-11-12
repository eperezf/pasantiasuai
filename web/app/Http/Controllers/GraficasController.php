<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use App\Repositories\PasantiasRepository;
use App\AuthUsers;
use App\Pasantia;
use App\Empresa;
use App\User;


class GraficasController extends Controller {
  public function index() {
		if (Auth::user()->rol >= 4) {
			$estadisticasInscripciones = $this->getEstadisticasInscripciones();
			$estadisticasEstadoDefensas = $this->getEstadisticasProyectos();
			$estadisticasEmpresas = $this->getEstadisticasEmpresas();
			$estadisticasPasantias = $this->getEstadisticasPasantias();
			return view('admin.estadisticas', compact('getEstadisticasProyectos', 'estadisticasEmpresas', 'estadisticasPasantias', 'estadisticasInscripciones'));
    } else {
      return redirect('index');
    }
	}

	public function getEstadisticasProyectos(){
		//Proyectos aprobados
		$proyectosAprobados = Pasantia::where('statusPaso4','=','4')->get();
		//cantidad
		$proyectosAprobadosCount = $proyectosAprobados->count();
		//alumnos
		$alumnosProyectosAprobados = $this->getAlumnos($proyectosAprobados);

		//Distinto de aprobados
		$proyectosNoAprobados = Pasantia::where('statusPaso4','!=','4')->get();
		//cantidad
		$proyectosNoAprobadosCount = $proyectosNoAprobados->count();
		//alumnos
		$alumnosProyectosNoAprobados = $this->getAlumnos($proyectosNoAprobados);

		//Porcentaje
		$total = $proyectosNoAprobadosCount + $proyectosAprobadosCount;
		$proyectosAprobadosPorcentaje = round($proyectosAprobadosCount / $total * 100, 2);
		$proyectosNoAprobadosPorcentaje = round($proyectosNoAprobadosCount / $total * 100, 2);

		$estadisticasInscripciones = array(
			'proyectosAprobados' => $proyectosAprobados,
			'proyectosAprobadosCount' => $proyectosAprobadosCount,
      'alumnosProyectosAprobados' => $alumnosProyectosAprobados,
			'proyectosNoAprobados' => $proyectosNoAprobados,
      'proyectosNoAprobadosCount' => $proyectosNoAprobadosCount,
			'alumnosProyectosNoAprobados' => $alumnosProyectosNoAprobados,
			'proyectosAprobadosPorcentaje' => $proyectosAprobadosPorcentaje,
			'proyectosNoAprobadosPorcentaje' => $proyectosNoAprobadosPorcentaje
		);
		return $estadisticasInscripciones;
	}

	public function getEstadisticasInscripciones() {
		//Terminadas
		$inscripcionesTerminadas = Pasantia::where('statusGeneral','=','1')->get();
		//cantidad
		$inscripcionesTerminadasCount = $inscripcionesTerminadas->count();
		//alumnos
		$alumnosInscripcionesTerminadas = $this->getAlumnos($inscripcionesTerminadas);

		//No terminadas
		$inscripcionesNoTerminadas = Pasantia::where('statusGeneral','=','0')->get();
		//cantidad
		$inscripcionesNoTerminadasCount = $inscripcionesNoTerminadas->count();
		//alumnos
		$alumnosInscripcionesNoTerminadas = $this->getAlumnos($inscripcionesNoTerminadas);

		//Porcentaje
		$total = $inscripcionesNoTerminadasCount + $inscripcionesTerminadasCount;
		$inscripcionesTerminadasPorcentaje = round($inscripcionesTerminadasCount / $total * 100, 2);
		$inscripcionesNoTerminadasPorcentaje = round($inscripcionesNoTerminadasCount / $total * 100, 2);

		$estadisticasInscripciones = array(
			'inscripcionesTerminadas' => $inscripcionesTerminadas,
			'alumnosInscripcionesTerminadas' => $alumnosInscripcionesTerminadas,
      'inscripcionesNoTerminadas' => $inscripcionesNoTerminadas,
			'alumnosInscripcionesNoTerminadas' => $alumnosInscripcionesNoTerminadas,
      'inscripcionesTerminadasCount' => $inscripcionesTerminadasCount,
			'inscripcionesNoTerminadasCount' => $inscripcionesNoTerminadasCount,
			'inscripcionesTerminadasPorcentaje' => $inscripcionesTerminadasPorcentaje,
			'inscripcionesNoTerminadasPorcentaje' => $inscripcionesNoTerminadasPorcentaje
		);
		return $estadisticasInscripciones;
	}

	public function getEstadisticasEmpresas() {
		//estadisticas Empresas --> en convenio, sin convenio, proceso convenio
		/* ---------- convenios ---------- */
		$empresasValidadas = Empresa::where('status', '=', '1')->get();
		$empresasNoValidadas = Empresa::where('status', '=', '0')->get();
		$empresasValidadasCount = $empresasValidadas->count();
		$empresasNoValidadasCount = $empresasNoValidadas->count();
		$empresasTotal = $empresasValidadasCount + $empresasNoValidadasCount;
		$empresasPorcentajeValidadas = round($empresasValidadasCount / $empresasTotal * 100, 2);
		$empresasPorcentajeNoValidadas = round($empresasNoValidadasCount / $empresasTotal * 100, 2);


		$estadisticasEmpresas = array(
			'empresasPorcentajeValidadas' => $empresasPorcentajeValidadas,
			'empresasPorcentajeNoValidadas' => $empresasPorcentajeNoValidadas,
      'empresasValidadas' => $empresasValidadas,
			'empresasNoValidadas' => $empresasNoValidadas,
      'empresasValidadasCount' => $empresasValidadasCount,
			'empresasNoValidadasCount' => $empresasNoValidadasCount,
			'empresasTotal' => $empresasTotal,
		);
		return $estadisticasEmpresas;
	}
	public function getEstadisticasPasantias() {
		//estadisticas Pasantias --> cantidad de alumnos en cada paso
		/* ---------- cantidad de alumnos en cada paso ---------- */
		//Hasta paso 4 completo
		$pasantiasPaso4 = Pasantia::where('statusPaso4','=','4')->get();
		$pasantiasPaso4Count = $pasantiasPaso4->count();
		$alumnosPasantiaPaso4 = $this->getAlumnos($pasantiasPaso4);
		//Hasta paso 3 completo
		$pasantiasPaso3 = Pasantia::where('statusPaso3','=','4')->where('statusPaso4', '!=', '4')->get();
		$pasantiasPaso3Count = $pasantiasPaso3->count();
		$alumnosPasantiaPaso3 = $this->getAlumnos($pasantiasPaso3);
		//Hasta paso 2 completo
		$pasantiasPaso2 = Pasantia::where('statusPaso2','=','2')->where('statusPaso3', '!=', '4')->where('statusPaso4', '!=', '4')->get();
		$pasantiasPaso2Count = $pasantiasPaso2->count();
		$alumnosPasantiaPaso2 = $this->getAlumnos($pasantiasPaso2);
		//Hasta paso 1 completo
		$pasantiasPaso1 = Pasantia::where('statusPaso1','=','2')->where('statusPaso2','!=','2')->where('statusPaso3', '!=', '4')->where('statusPaso4', '!=', '4')->get();
		$pasantiasPaso1Count = $pasantiasPaso1->count();
		$alumnosPasantiaPaso1 = $this->getAlumnos($pasantiasPaso1);
		//total
		$pasantiasTotal = $pasantiasPaso4Count + $pasantiasPaso3Count + $pasantiasPaso2Count + $pasantiasPaso1Count;
		//Array de estadisticas
    $estadisticasPasantias = array(
			'alumnosPasantiaPaso4' => $alumnosPasantiaPaso4,
      'alumnosPasantiaPaso3' => $alumnosPasantiaPaso3,
      'alumnosPasantiaPaso2' => $alumnosPasantiaPaso2,
			'alumnosPasantiaPaso1' => $alumnosPasantiaPaso1,
			'pasantiasPaso4' => $pasantiasPaso4,
      'pasantiasPaso3' => $pasantiasPaso3,
      'pasantiasPaso2' => $pasantiasPaso2,
      'pasantiasPaso1' => $pasantiasPaso1,
      'pasantiasPaso4Count' => $pasantiasPaso4Count,
      'pasantiasPaso3Count' => $pasantiasPaso3Count,
      'pasantiasPaso2Count' => $pasantiasPaso2Count,
      'pasantiasPaso1Count' => $pasantiasPaso1Count,
			'pasantiasTotal' => $pasantiasTotal,
		);
    return $estadisticasPasantias;
	}
	public function getAlumnos($pasantias) {
		$alumnosPasantia = array();
		foreach ($pasantias as $pasantia) {
			array_push($alumnosPasantia, User::where('idUsuario', $pasantia->idAlumno)->get());
		}
		return Arr::flatten($alumnosPasantia);
	}
}
