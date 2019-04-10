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
				return view('pasantia.paso0', ['statusPaso0'=>$pasantia->statusPaso0, 'reglamento' => '0']);
			}
			else {
				return view('pasantia.paso0',['reglamento' => '1','statusPaso0'=>$pasantia->statusPaso0]);
			}
		}
		else {
			$pasantia = new Pasantia;
			$pasantia->idAlumno = $userId;
			$pasantia->save();
			return view('pasantia.paso0',['statusPaso0'=>$pasantia->statusPaso0, 'reglamento' => '0']);
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
		if ($pasantia){
			return view('pasantia.paso1',['statusPaso0'=>$pasantia->statusPaso0]);
		}

	}

	public function paso1Control(){
		return redirect('/inscripcion/2');
	}

	public function paso2View(){
		return view('pasantia.paso2');
	}

	public function paso2Control(){
		return redirect('/inscripcion/3');
	}

	public function paso3View(){
		return view('pasantia.paso3');
	}

	public function paso3Control(){
		return redirect('/inscripcion/4');
	}

	public function paso4View(){
		return view('pasantia.paso4');
	}
	public function paso4Control(){

	}

}
