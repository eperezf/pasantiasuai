<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pasantia;
use Auth;

class PasantiaController extends Controller{
	public function paso0View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia){
			if ($pasantia->lecReglamento == 0){
				return view('pasantia.paso0', [
					'statusPaso0'=>$pasantia->statusPaso0,
					'statusPaso1'=>$pasantia->statusPaso1,
					'statusPaso2'=>$pasantia->statusPaso2,
					'statusPaso3'=>$pasantia->statusPaso3,
					'statusPaso4'=>$pasantia->statusPaso4,
					'reglamento' => '0']);
			}
			else {
				return view('pasantia.paso0', [
					'statusPaso0'=>$pasantia->statusPaso0,
					'statusPaso1'=>$pasantia->statusPaso1,
					'statusPaso2'=>$pasantia->statusPaso2,
					'statusPaso3'=>$pasantia->statusPaso3,
					'statusPaso4'=>$pasantia->statusPaso4,
					'reglamento' => '1']);
			}
		}
		else {
			$pasantia = new Pasantia;
			$pasantia->idAlumno = $userId;
			$pasantia->save();
			return view('pasantia.paso0', [
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4,
				'reglamento' => '0']);
		}
	}

	public function paso0Control(Request $request){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia->lecReglamento == 1){
			return redirect('/inscripcion/1');
		}
		else {
			if ($request->reglamento == 1){
				$pasantia->lecReglamento = 1;
				$pasantia->statusPaso0 = 2;
				$pasantia->save();
				return redirect('/inscripcion/1');
			}
			else {
				return redirect('inscripcion/0')->with('error', 'Debes aceptar el reglamento para continuar con tu inscripción');
			}
		}
	}

	public function paso1View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0==2){
			return view('pasantia.paso1',[
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4]);
		}
		else {
			return redirect('/inscripcion/0');
		}

	}
	public function paso1Control(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$pasantia->statusPaso1 = 2;
		$pasantia->save();
		return redirect('/inscripcion/2');
	}

	public function paso2View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0==2){
			return view('pasantia.paso2', [
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4,
				'ciudad'=>$pasantia->ciudad,
				'pais'=>$pasantia->pais,
				'fecha'=>$pasantia->fechaInicio,
				'horas'=>$pasantia->horasSemanales,
				'pariente'=>$pasantia->parienteEmpresa
			]);
		}
		else {
			return redirect('/inscripcion/0');
		}
	}

	public function paso2Control(Request $request){
		$incompleto = false;
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$pasantia->parienteEmpresa = $request->pariente;
		$pasantia->save();

		if ($request->ciudad){
			$pasantia->ciudad = $request->ciudad;
			$pasantia->save();
		}
		else {
			$pasantia->ciudad = null;
			$pasantia->save();
			$incompleto = true;
		}
		if ($request->pais){
			$pasantia->pais = $request->pais;
			$pasantia->save();
		}
		else {
			$incompleto = true;
		}
		if ($request->fecha){
			$pasantia->fechaInicio = $request->fecha;
			$pasantia->save();
		}
		else {
			$incompleto = true;
		}
		if ($request->horas){
			$pasantia->horasSemanales = $request->horas;
			$pasantia->save();
		}
		else {
			$incompleto = true;
		}
		if ($incompleto == true){
			$pasantia->statusPaso2 = 1;
			$pasantia->save();
		}
		else {
			$pasantia->statusPaso2 = 2;
			$pasantia->save();
		}
		return redirect('/inscripcion/3');
	}

	public function paso3View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0==2){
			return view('pasantia.paso3',[
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4,
				'nombre'=>$pasantia->nombreJefe,
				'correo'=>$pasantia->correoJefe]);
		}
		else {
			return redirect('/inscripcion/0');
		}
	}

	public function paso3Control(Request $request){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$pasantia->nombreJefe = $request->nombre;
		$pasantia->correoJefe = $request->email;
		if ($request->guardar){
			$pasantia->statusPaso3 = 1;
			$pasantia->save();
		}
		if ($request->enviar){
			$pasantia->statusPaso3 = 2;
			//Enviar correo
			$pasantia->save();
		}
		return redirect('/inscripcion/4');


	}

	public function paso4View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0==2){
			return view('pasantia.paso4', [
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4]);
		}
		else {
			return redirect('/inscripcion/0');
		}
	}
	public function paso4Control(){
		return redirect('/inscripcion/resumen');
	}
	public function resumenView(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		return view('pasantia.resumen', [
			'statusPaso0'=>$pasantia->statusPaso0,
			'statusPaso1'=>$pasantia->statusPaso1,
			'statusPaso2'=>$pasantia->statusPaso2,
			'statusPaso3'=>$pasantia->statusPaso3,
			'statusPaso4'=>$pasantia->statusPaso4]);
	}

}
