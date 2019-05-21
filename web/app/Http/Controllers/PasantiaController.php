<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Pasantia;
use App\Empresa;
use Auth;

class PasantiaController extends Controller{
	/**
   * Muestra el Paso 0
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
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

	/**
   * Comprueba si el alumno aceptó el reglamento
   * @author Eduardo Pérez
   * @version v1.0
	 * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
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

	/**
   * Muestra el Paso 1
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
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

	/**
   * Guarda los datos de tipo de malla y práctica operario
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
	public function paso1Control(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$pasantia->statusPaso1 = 2;
		$pasantia->save();
		return redirect('/inscripcion/2');
	}

	/**
   * Muestra el Paso 2
   * @author Eduardo Pérez
   * @version v1.1
   * @return \Illuminate\Http\Response
   */
	public function paso2View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$empresas = Empresa::all()->sortBy('nombre');
		$empresaSel = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
		if (!$empresaSel){
			$empresaSel = new Empresa([
				'nombre'=>"",
				'rubro'=>"",
				'urlWeb'=>"",
				'correoContacto'=>"",
				'status'=>"0"
			]);
		}
		if ($pasantia && $pasantia->statusPaso0==2){
			return view('pasantia.paso2', [
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4,
				'empresas'=>$empresas,
				'empresaSel'=>$empresaSel,
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

	/**
   * Guarda los datos de la pasantía
   * @author Eduardo Pérez
   * @version v1.3
	 * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
	public function paso2Control(Request $request){
		$incompleto = false;
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$pasantia->parienteEmpresa = $request->pariente;
		$empresaSel = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
		if(!$empresaSel){
			$empresaSel = new Empresa([
				'nombre'=>null,
				'rubro'=>null,
				'urlWeb'=>null,
				'correoContacto'=>null,
				'status'=>"2"
			]);
		}
		$pasantia->save();
		if ($request->pariente == 1){
			$pasantia->idEmpresa = null;
			$pasantia->statusPaso2 = 1;
			$pasantia->parienteEmpresa = 0;
			$pasantia->save();
			return redirect('/inscripcion/2')->with('danger', 'No puede inscribir su pasantía en una empresa en la que tiene un familiar que trabaja en la empresa o es socio/dueño de esta, por favor inscriba su pasantía en otra empresa (Su empresa ha sido deseleccionada).');
		}
		if ($request->empresa){
			$pasantia->idEmpresa = $request->empresa;
			$pasantia->save();
		}
		else {
			if (!$request->otraEmpresa){
				$pasantia->idEmpresa = null;
				$pasantia->save();
				$incompleto = true;
			}
		}
		if ($request->otraEmpresa && $request->nombreOtraEmpresa){
			if ($request->nombreOtraEmpresa != $empresaSel->nombre){
				if(Empresa::where('nombre', $request->nombreOtraEmpresa)->first()){
					$pasantia->idEmpresa = Empresa::where('nombre', $request->nombreOtraEmpresa)->first()->idEmpresa;
				}
				else {
					$empresa = new Empresa([
						'nombre'=>$request->get('nombreOtraEmpresa'),
						'rubro'=>"Rubro " . $request->get('nombreOtraEmpresa'),
						'urlWeb'=>Str::slug($request->get('nombreOtraEmpresa')).".com",
						'correoContacto'=>"contacto@".Str::slug($request->get('nombreOtraEmpresa')).".com",
						'status'=>"2"
					]);
					$empresa->save();
					$pasantia->idEmpresa = $empresa->idEmpresa;
					$pasantia->save();
				}
			}
		}
		else {
			return redirect('/inscripcion/2')->with('danger', 'El nombre de la empresa no puede estar en blanco.');
		}

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
			if ($request->horas < 0 || $request->horas > 45){
				return redirect('/inscripcion/2');
			}
			else{
				$pasantia->horasSemanales = $request->horas;
				$pasantia->save();
			}
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

	/**
   * Muestra el Paso 3
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
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

	/**
   * Guarda los datos del supervisor
   * @author Eduardo Pérez
   * @version v1.1
	 * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
	public function paso3Control(Request $request){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($request->nombre == "" || $request->email == ""){
			$pasantia->statusPaso3 = 1;
		}
		else {
			$pasantia->statusPaso3 = 2;
		}
		$pasantia->nombreJefe = $request->nombre;
		$pasantia->correoJefe = $request->email;
		if ($request->guardar){
			$pasantia->save();
		}
		if ($request->enviar){
			$pasantia->statusPaso3 = 3;
			//Enviar correo
			$pasantia->save();
		}
		return redirect('/inscripcion/4');


	}

	/**
   * Muestra el Paso 4
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
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

	/**
   * Guarda los datos del proyecto de pasantía
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
	public function paso4Control(){
		return redirect('/inscripcion/resumen');
	}

	/**
   * Muestra el Resumen de inscripción
   * @author Eduardo Pérez
   * @version v1.0
   * @return \Illuminate\Http\Response
   */
	public function resumenView(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0 == 2){
			$empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
			return view('pasantia.resumen', [
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4,
				'pasantia'=>$pasantia,
				'empresa'=>$empresa]);
		}
		else {
			return redirect('/inscripcion/0');
		}
	}

	/**
	 * Elimina la pasantía de la base de datos. (SOLO PARA QA)
	 * @version v1.0
	 * @author Eduardo Pérez
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		if (Auth::user()->rol >=4){
			$userId = Auth::id();
			$pasantia = Pasantia::where('idAlumno', $userId)->first();
			$pasantia->delete();
			return redirect('/inscripcion/0');
		}
		else {
			return redirect('/inscripcion/resumen');
		}

	}
}
