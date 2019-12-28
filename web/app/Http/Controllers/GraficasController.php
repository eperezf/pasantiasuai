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


class GraficasController extends Controller
{
	public function index()
	{
		if (Auth::user()->rol >= 4) {
			$estadisticasSupervisores = $this->getEstadisticasSupervisores();
			$estadisticasInscripciones = $this->getEstadisticasInscripciones();
			$estadisticasProyectos = $this->getEstadisticasProyectos();
			$estadisticasEmpresas = $this->getEstadisticasEmpresas();
			$estadisticasPasantias = $this->getEstadisticasPasantias();
			return view('admin.estadisticas', compact('estadisticasSupervisores', 'estadisticasInscripciones', 'estadisticasProyectos', 'estadisticasEmpresas', 'estadisticasPasantias'));
		} else {
			return redirect('index');
		}
	}

	public function getEstadisticasSupervisores()
	{
		//Proyectos aprobados
		$pasantiasValidadasSupervisor = Pasantia::where('statusPaso3', '=', '4')->get();
		//cantidad
		$pasantiasValidadasSupervisorCount = $pasantiasValidadasSupervisor->count();
		//alumnos
		$alumnosPasantiasValidadasSupervisor = $this->getAlumnos($pasantiasValidadasSupervisor);

		//Distinto de aprobados -> objetado o no validado
		$pasantiasNoValidadasSupervisor = Pasantia::where('statusPaso3', '=', '3')->get();
		//cantidad
		$pasantiasNoValidadasSupervisorCount = $pasantiasNoValidadasSupervisor->count();
		//alumnos
		$alumnosNoPasantiasValidadasSupervisor = $this->getAlumnos($pasantiasNoValidadasSupervisor);

		//Porcentaje
		$total = $pasantiasNoValidadasSupervisorCount + $pasantiasValidadasSupervisorCount;
		if ($total == 0) {
			$pasantiasValidadasSupervisorPorcentaje = 0;
			$pasantiasNoValidadasSupervisorPorcentaje = 0;
		} else {
			$pasantiasValidadasSupervisorPorcentaje = round($pasantiasValidadasSupervisorCount / $total * 100, 2);
			$pasantiasNoValidadasSupervisorPorcentaje = round($pasantiasNoValidadasSupervisorCount / $total * 100, 2);
		}


		$estadisticasSupervisores = array(
			'pasantiasValidadasSupervisor' => $pasantiasValidadasSupervisor,
			'pasantiasValidadasSupervisorCount' => $pasantiasValidadasSupervisorCount,
			'alumnosPasantiasValidadasSupervisor' => $alumnosPasantiasValidadasSupervisor,

			'pasantiasNoValidadasSupervisor' => $pasantiasNoValidadasSupervisor,
			'pasantiasNoValidadasSupervisorCount' => $pasantiasNoValidadasSupervisorCount,
			'alumnosNoPasantiasValidadasSupervisor' => $alumnosNoPasantiasValidadasSupervisor,

			'pasantiasValidadasSupervisorPorcentaje' => $pasantiasValidadasSupervisorPorcentaje,
			'pasantiasNoValidadasSupervisorPorcentaje' => $pasantiasNoValidadasSupervisorPorcentaje
		);
		return $estadisticasSupervisores;
	}

	public function getEstadisticasProyectos()
	{
		//Proyectos aprobados
		$proyectosAprobados = Pasantia::where('statusPaso4', '=', '4')->get();
		//cantidad
		$proyectosAprobadosCount = $proyectosAprobados->count();
		//alumnos
		$alumnosProyectosAprobados = $this->getAlumnos($proyectosAprobados);

		//Distinto de aprobados -> objetado o no validado
		$proyectosNoAprobados = Pasantia::whereBetween('statusPaso4', [2, 3])->get();
		//cantidad
		$proyectosNoAprobadosCount = $proyectosNoAprobados->count();
		//alumnos
		$alumnosProyectosNoAprobados = $this->getAlumnos($proyectosNoAprobados);

		//Porcentaje
		$total = $proyectosNoAprobadosCount + $proyectosAprobadosCount;
		if ($total == 0) {
			$proyectosAprobadosPorcentaje = 0;
			$proyectosNoAprobadosPorcentaje = 0;
		} else {
			$proyectosAprobadosPorcentaje = round($proyectosAprobadosCount / $total * 100, 2);
			$proyectosNoAprobadosPorcentaje = round($proyectosNoAprobadosCount / $total * 100, 2);
		}

		$estadisticasProyectos = array(
			'proyectosAprobados' => $proyectosAprobados,
			'proyectosAprobadosCount' => $proyectosAprobadosCount,
			'alumnosProyectosAprobados' => $alumnosProyectosAprobados,

			'proyectosNoAprobados' => $proyectosNoAprobados,
			'proyectosNoAprobadosCount' => $proyectosNoAprobadosCount,
			'alumnosProyectosNoAprobados' => $alumnosProyectosNoAprobados,

			'proyectosAprobadosPorcentaje' => $proyectosAprobadosPorcentaje,
			'proyectosNoAprobadosPorcentaje' => $proyectosNoAprobadosPorcentaje
		);
		return $estadisticasProyectos;
	}

	public function getEstadisticasInscripciones()
	{
		$pasantias = Pasantia::all();
		$inscripcionesTerminadas = array();
		$inscripcionesNoTerminadas = array();

		foreach ($pasantias as $pasantia) {
			if ($this->isPasantiaTerminada($pasantia)) {
				array_push($inscripcionesTerminadas, $pasantia);
			}
			if (!$this->isPasantiaTerminada($pasantia)) {
				array_push($inscripcionesNoTerminadas, $pasantia);
			}
		}

		$inscripcionesTerminadas = collect(Arr::flatten($inscripcionesTerminadas));
		$inscripcionesNoTerminadas = collect(Arr::flatten($inscripcionesNoTerminadas));
		//collect(Arr::flatten($inscripcionesTerminadas));
		//collect(Arr::flatten($inscripcionesNoTerminadas));

		//Terminados
		$inscripcionesTerminadasCount = $inscripcionesTerminadas->count();
		$alumnosInscripcionesTerminadas = $this->getAlumnos($inscripcionesTerminadas);

		//No terminados
		$inscripcionesNoTerminadasCount = $inscripcionesNoTerminadas->count();
		$alumnosInscripcionesNoTerminadas = $this->getAlumnos($inscripcionesNoTerminadas);


		//Porcentaje
		$total = $inscripcionesNoTerminadasCount + $inscripcionesTerminadasCount;
		if ($total == 0) {
			$inscripcionesTerminadasPorcentaje = 0;
			$inscripcionesNoTerminadasPorcentaje = 0;
		} else {
			$inscripcionesTerminadasPorcentaje = round($inscripcionesTerminadasCount / $total * 100, 2);
			$inscripcionesNoTerminadasPorcentaje = round($inscripcionesNoTerminadasCount / $total * 100, 2);
		}

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

	public function getEstadisticasEmpresas()
	{
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
	public function getEstadisticasPasantias()
	{
		//estadisticas Pasantias --> cantidad de alumnos en cada paso
		/* ---------- cantidad de alumnos en cada paso ---------- */
		//Hasta paso 4 completo
		$pasantiasPaso4 = Pasantia::where('statusPaso4', '=', '4')->get();
		$pasantiasPaso4Count = $pasantiasPaso4->count();
		$alumnosPasantiaPaso4 = $this->getAlumnos($pasantiasPaso4);
		//Hasta paso 3 completo
		$pasantiasPaso3 = Pasantia::where('statusPaso3', '=', '4')->where('statusPaso4', '!=', '4')->get();
		$pasantiasPaso3Count = $pasantiasPaso3->count();
		$alumnosPasantiaPaso3 = $this->getAlumnos($pasantiasPaso3);
		//Hasta paso 2 completo
		$pasantiasPaso2 = Pasantia::where('statusPaso2', '=', '2')->where('statusPaso3', '!=', '4')->where('statusPaso4', '!=', '4')->get();
		$pasantiasPaso2Count = $pasantiasPaso2->count();
		$alumnosPasantiaPaso2 = $this->getAlumnos($pasantiasPaso2);
		//Hasta paso 1 completo
		$pasantiasPaso1 = Pasantia::where('statusPaso1', '=', '2')->where('statusPaso2', '!=', '2')->where('statusPaso3', '!=', '4')->where('statusPaso4', '!=', '4')->get();
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
	public function getAlumnos($pasantias)
	{
		$alumnosPasantia = array();
		foreach ($pasantias as $pasantia) {
			array_push($alumnosPasantia, User::where('idUsuario', $pasantia->idAlumno)->get());
		}
		return Arr::flatten($alumnosPasantia);
	}

	public function isPasantiaTerminada($pasantia)
	{
		$horasSemanales = $pasantia->horasSemanales;
		$totalHoras = 810;
		$totalSemanas = round($totalHoras / $horasSemanales);
		$fechaTermino = Carbon::parse($pasantia->fechaInicio);
		$fechaTermino->addWeeks($totalSemanas);
		if (Carbon::now() > $fechaTermino) {
			return true;
		} else {
			return false;
		}
	}
}
