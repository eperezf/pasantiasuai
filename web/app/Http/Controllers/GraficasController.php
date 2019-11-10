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
			$estadisticas = $this->getEstadisticas();
			return view('admin.estadisticas', compact('estadisticas'));
    } else {
      return redirect('index');
    }
	}

	public function getEstadisticas() {
		//estadisticas Pasantias --> cantidad de alumnos en cada paso + estado defensas

		/* ---------- cantidad de alumnos en cada paso ---------- */
		//Hasta paso 4 completo
		$pasantiasPaso4 = Pasantia::where('statusPaso4','=','4');
		$pasantiasPaso4Count = $pasantiasPaso4->count();
		//Hasta paso 3 completo
		$pasantiasPaso3 = Pasantia::where('statusPaso3','=','4')->where('statusPaso4', '!=', '4');
		$pasantiasPaso3Count = $pasantiasPaso3->count();
		//Hasta paso 2 completo
		$pasantiasPaso2 = Pasantia::where('statusPaso2','=','2')->where('statusPaso3', '!=', '4')->where('statusPaso4', '!=', '4');
		$pasantiasPaso2Count = $pasantiasPaso2->count();
		//Hasta paso 1 completo
		$pasantiasPaso1 = Pasantia::where('statusPaso1','=','2')->where('statusPaso2','!=','2')->where('statusPaso3', '!=', '4')->where('statusPaso4', '!=', '4');
		$pasantiasPaso1Count = $pasantiasPaso1->count();
		//total
		$pasantiasTotal = $pasantiasPaso4Count + $pasantiasPaso3Count + $pasantiasPaso2Count + $pasantiasPaso1Count;

		/* ---------- estado defensas ---------- */



    //estadisticas Empresas --> en convenio, sin convenio, proceso convenio
		$empresasEnProceso = Empresa::where('status', '=', '2');
		$empresasValidadas = Empresa::where('status', '=', '1');
		$empresasNoValidadas = Empresa::where('status', '=', '0');
		$empresasEnProcesoCount = $empresasEnProceso->count();
		$empresasValidadasCount = $empresasValidadas->count();
		$empresasNoValidadasCount = $empresasNoValidadas->count();
		$empresasTotal = $empresasEnProcesoCount + $empresasValidadasCount + $empresasNoValidadasCount;

		//Array de estadisticas
    $estadisticas = array(
			'pasantiasPaso4' => $pasantiasPaso4,
      'pasantiasPaso3' => $pasantiasPaso3,
      'pasantiasPaso2' => $pasantiasPaso2,
      'pasantiasPaso1' => $pasantiasPaso1,
      'pasantiasPaso4Count' => $pasantiasPaso4Count,
      'pasantiasPaso3Count' => $pasantiasPaso3Count,
      'pasantiasPaso2Count' => $pasantiasPaso2Count,
      'pasantiasPaso1Count' => $pasantiasPaso1Count,
			'pasantiasTotal' => $pasantiasTotal,
			'empresasEnProceso' => $empresasEnProceso,
      'empresasValidadas' => $empresasValidadas,
			'empresasNoValidadas' => $empresasNoValidadas,
      'empresasEnProcesoCount' => $empresasEnProcesoCount,
      'empresasValidadasCount' => $empresasValidadasCount,
			'empresasNoValidadasCount' => $empresasNoValidadasCount,
			'empresasTotal' => $empresasTotal,
		);
    return $estadisticas;
	}
}





