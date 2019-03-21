<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasantiaController extends Controller{
	public function paso0View(){
		return view('pasantia.paso0');
	}

	public function paso0Control(Request $request){
		if ($request->reglamento == NULL){
			$request->reglamento = 0;
		}
		echo $request->reglamento;
		return redirect('/inscripcion/1');
	}

	public function paso1View(){

	}

	public function paso1Contro(){

	}

	public function paso2View(){

	}

	public function paso2Control(){

	}

	public function paso3View(){

	}

	public function paso3Control(){

	}

	public function paso4View(){

	}
	public function paso4Control(){

	}

}
