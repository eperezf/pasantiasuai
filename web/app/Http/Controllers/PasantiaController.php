<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ConfTutor;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\User;
use App\AuthUsers;
use App\Pasantia;
use App\Empresa;
use Auth;
use PDF;


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
		$tipoMalla = AuthUsers::where('email', Auth::user()->email)->first()->tipoMalla;

		if ($pasantia && $pasantia->statusPaso0==2){
			$pasantia->modalidad = $tipoMalla;
			$pasantia->save();
			return view('pasantia.paso1',[
				'statusPaso0'=>$pasantia->statusPaso0,
				'statusPaso1'=>$pasantia->statusPaso1,
				'statusPaso2'=>$pasantia->statusPaso2,
				'statusPaso3'=>$pasantia->statusPaso3,
				'statusPaso4'=>$pasantia->statusPaso4,
				'tipoMalla'=>$tipoMalla]);
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
				'pariente'=>$pasantia->parienteEmpresa,
				'rolPariente' =>$pasantia->rolPariente
			]);
		}
		else {
			return redirect('/inscripcion/0');
		}
	}

	/**
   * Guarda los datos de la pasantía
   * @author Eduardo Pérez
   * @version v2.0
	 * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
	public function paso2Control(Request $request){
		$request->validate([
			'empresa' => 'numeric|nullable',
			'ciudad' => 'alpha|nullable',
			'pais' => 'alpha|nullable',
			'fecha' => 'date|nullable',
			'horas' => 'integer|between:20,45|nullable',
			'pariente' => 'boolean|nullable',
			'otraEmpresa' => 'boolean|nullable',
			'rolPariente' => 'required_if:pariente,1'
		]);
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$incompleto = false;
		if ($request->otraEmpresa){
			if (!$request->nombreOtraEmpresa){
				return redirect('/inscripcion/2')->with('danger', 'El nombre de la empresa no puede estar en blanco.');
			}
			else {
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
				}
			}
		}
		else {
			$pasantia->idEmpresa = Empresa::where('idEmpresa', $request->empresa)->first()->idEmpresa;
		}
		if (!$request->pais || !$request->ciudad || !$request->fecha || !$request->horas){
			$incompleto = true;
		}


		if ($request->fecha) {
			//Limite de la fecha de inscripcion respecto al año actual
			$fechaInicio = Carbon::parse(Carbon::create(Carbon::now()->year, 7, 22)); //22 Julio
			$fechaLimite = Carbon::parse(Carbon::create(Carbon::now()->year, 8, 16)); //16 Agosto
			//Si hoy o la fecha de inscripcion es mayor a la fecha limite
			if (Carbon::now() > $fechaLimite || Carbon::parse($request->fecha) > $fechaLimite) {
				return redirect('/inscripcion/2')->with('danger', 'Su pasantía no la puede inscribir en esta fecha, si aún asi desea realizarla, deberá contactarse con pasantias.fic@uai.cl');
			}
			if (Carbon::parse($request->fecha) < $fechaInicio) {
				return redirect('/inscripcion/2')->with('danger', 'El rango de fechas permitido para iniciar pasantías es desde el 12 de Julio hasta el 31 de Agosto.');
			}
			//Si desea inscribir en una fecha menor a la de hoy
			if (Carbon::parse($request->fecha) < Carbon::now()) {
				return redirect('/inscripcion/2')->with('danger', 'La fecha de inicio de su pasantía debe ser futura.');
			}
		}

		if ($request->pariente == 1){
			$pasantia->parienteEmpresa = 1;
			if (!$request->rolPariente){
				return redirect('/inscripcion/2')->with('danger', 'El rol del pariente no puede estar en blanco.');
			}
			else {
				$pasantia->rolPariente = $request->rolPariente;
			}
		}
		else {
			$pasantia->parienteEmpresa = 0;
			$pasantia->rolPariente = null;
		}
		if ($incompleto == true){
			$pasantia->statusPaso2 = 1;
		}
		else {
			$pasantia->statusPaso2 = 2;
		}
		if ($request->pariente == 1){
			$pasantia->statusPaso2 = 3;
		}
		$pasantia->pais = $request->pais;
		$pasantia->ciudad = $request->ciudad;
		$pasantia->fechaInicio = $request->fecha;
		$pasantia->horasSemanales = $request->horas;
		$pasantia->save();
		return redirect('/inscripcion/3');
	}

	/**
   * Muestra el Paso 3
   * @author Eduardo Pérez
   * @version v1.1
   * @return \Illuminate\Http\Response
   */
	public function paso3View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0==2){
			if ($pasantia->statusPaso2 == 3){
				return redirect('/inscripcion/2')->with('danger', 'No puedes continuar tu proceso de inscripción si tienes un pariente en la empresa. Tu pasantía está a la espera de validación.');
			}
			else {
				return view('pasantia.paso3',[
					'statusPaso0'=>$pasantia->statusPaso0,
					'statusPaso1'=>$pasantia->statusPaso1,
					'statusPaso2'=>$pasantia->statusPaso2,
					'statusPaso3'=>$pasantia->statusPaso3,
					'statusPaso4'=>$pasantia->statusPaso4,
					'nombre'=>$pasantia->nombreJefe,
					'correo'=>$pasantia->correoJefe]);
			}
		}
		else {
			return redirect('/inscripcion/0');
		}
	}

	/**
   * Guarda los datos del supervisor
   * @author Eduardo Pérez
   * @version v1.2
	 * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
	public function paso3Control(Request $request){
		$userId = Auth::id();
		$user = Auth::user();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
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
			while(Pasantia::where('tokenCorreo', $pasantia->tokenCorreo)->first()){
				$pasantia->tokenCorreo = $string = str_random(10);
			}
			$pasantia->statusPaso3 = 3;
			$pasantia->save();
			Mail::to($pasantia->correoJefe)->send(new ConfTutor($pasantia, $user, $empresa));
		}
		return redirect('/inscripcion/resumen');


	}

	/**
   * Muestra el Paso 4
   * @author Eduardo Pérez
   * @version v1.1
   * @return \Illuminate\Http\Response
   */
	public function paso4View(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		if ($pasantia && $pasantia->statusPaso0==2){
			if ($pasantia->statusPaso2 == 3){
				return redirect('/inscripcion/2')->with('danger', 'No puedes continuar tu proceso de inscripción si tienes un pariente en la empresa. Su pasantía quedará en un estado pendiente de validación, lo que podría tardar el proceso de su inscripción.');
			}
			else {
				return view('pasantia.paso4', [
					'statusPaso0'=>$pasantia->statusPaso0,
					'statusPaso1'=>$pasantia->statusPaso1,
					'statusPaso2'=>$pasantia->statusPaso2,
					'statusPaso3'=>$pasantia->statusPaso3,
					'statusPaso4'=>$pasantia->statusPaso4]);
			}
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
				'statusGeneral' =>$pasantia->statusGeneral,
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

	/**
	 * Envía el correo de confirmación de tutor
	 * @version v1.1
	 * @author Eduardo Pérez
	 */
	public function enviarCorreo(){
		$userId = Auth::id();
		$user = Auth::user();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
		Mail::to($pasantia->correoJefe)->send($pasantia, $user, $empresa);

	}

	/**
	 * Confirma que la persona será el tutor del alumno.
	 * @version v1.0
	 * @author Eduardo Pérez
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function confirmarTutor($id){
		if (Pasantia::where('tokenCorreo', $id)->first()){
			$pasantia = Pasantia::where('tokenCorreo', $id)->first();
			$pasantia->statusPaso3 = 4;
			$pasantia->save();

			return view('pasantia.confTutor', [
				'display'=>'confirmado',
				'nombreJefe'=> $pasantia->nombreJefe,
				'nombreAlumno' => $pasantia->alumno->nombres . " " . $pasantia->alumno->apellidoPaterno,
				'nombreEmpresa' => $pasantia->empresa->nombre
			]);
		}
		else {
			return view('pasantia.confTutor', [
				'display'=>'error'
			]);
		}
	}


	/**
	 * Genera y descarga el certificado de inscripción de pasantía en PDF
	 * @version v1.0
	 * @author Eduardo Pérez
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function descargarCert(){
		$fecha = Carbon::now()->locale('es');
		$fechaParse = $fecha->isoFormat('LL');
		$user = Auth::user();
		$pasantia = $user->pasantia->first();
		$empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();

		$data = [
			'fecha' => $fechaParse,
			'nombre' => $user->nombres . " " . $user->apellidoPaterno . " " . $user->apellidoMaterno,
			'rut' => $user->rut,
			'carrera' => 'Ingeniería Civil',
			'nombreEmpresa' => $empresa->nombre
		];
		//return view('pasantia/certificado', $data);
		$pdf = PDF::loadView('pasantia/certificado', $data)->setPaper('letter', 'portrait');
		return $pdf->download('Certificado Pasantía ' . $user->nombres . " " . $user->apellidoPaterno . " " . $user->apellidoMaterno . ".pdf");
	}
}
