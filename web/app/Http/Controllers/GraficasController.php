<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\PasantiasRepository;
use App\AuthUsers;
use App\Pasantia;
use App\Empresa;
use App\User;


class GraficasController extends Controller {
  public function index() {
    $userId = Auth::id();
    $pasantia = Pasantia::where('idAlumno', $userId)->first();
    if ($pasantia != null) {
      $empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
    } else {
      $empresa = null;
    }
		$estadisticas = $this->getEstadisticas();
		$datosPasantias = PasantiasRepository::getAllPasantias();
		return view('admin.estadisticas', compact('estadisticas', 'datosPasantias'));
	}

	public function getEstadisticas() {
		//estadisticas Pasantias --> cantidad de alumnos en cada paso + estado defensas

		/* ---------- cantidad de alumnos en cada paso ---------- */
		//Hasta paso 4 completo
		$pasantiasPaso4 = pasantia::where('statusPaso4','=','4')->count();
		//Hasta paso 3 completo
		$pasantiasPaso3 = pasantia::where('statusPaso3','=','4')->count() - $pasantiasPaso4;
		if ($pasantiasPaso3 < 0) {$pasantiasPaso3 = 0;}
		//Hasta paso 2 completo
		$pasantiasPaso2 = pasantia::where('statusPaso2','=','2')->count() - $pasantiasPaso4 - $pasantiasPaso3;
		if ($pasantiasPaso2 < 0) {$pasantiasPaso2 = 0;}
		//Hasta paso 1 completo
		$pasantiasPaso1 = pasantia::where('statusPaso1','=','2')->count() - $pasantiasPaso4 - $pasantiasPaso3 - $pasantiasPaso2;
		if ($pasantiasPaso1 < 0) {$pasantiasPaso1 = 0;}
		//total
		$pasantiasTotal = $pasantiasPaso4 + $pasantiasPaso3 + $pasantiasPaso2 + $pasantiasPaso1;

		/* ---------- estado defensas ---------- */



    //estadisticas Empresas --> en convenio, sin convenio, proceso convenio
		$empresasEnProceso = Empresa::where('status', '=', '2')->count();
		$empresasValidadas = Empresa::where('status', '=', '1')->count();
		$empresasNoValidadas = Empresa::where('status', '=', '0')->count();
		$empresasTotal = $empresasEnProceso + $empresasValidadas + $empresasNoValidadas;

		//Array de estadisticas
    $estadisticas = array(
      'pasantiasPaso4' => $pasantiasPaso4,
      'pasantiasPaso3' => $pasantiasPaso3,
      'pasantiasPaso2' => $pasantiasPaso2,
      'pasantiasPaso1' => $pasantiasPaso1,
      'pasantiasTotal' => $pasantiasTotal,
      'empresasEnProceso' => $empresasEnProceso,
      'empresasValidadas' => $empresasValidadas,
			'empresasNoValidadas' => $empresasNoValidadas,
			'empresasTotal' => $empresasTotal,
		);
    return $estadisticas;
	}
}





