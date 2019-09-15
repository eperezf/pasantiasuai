<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\EvalTutorMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\AuthUsers;
use App\Pasantia;
use App\Empresa;
use App\EvalTutor;
use Auth;

class EvalTutorController extends Controller{
	public function show($id){
		$evaltutor = EvalTutor::where('idEncuesta',$id)->first();
		if(!$evaltutor->certificadoTutor)
		{
			return view('evalTutor.formulario',['id' => $id]);
		}	
	}

	public function save(Request $request){
		$evaltutor = EvalTutor::where('idEncuesta',$request->idEncuesta)->first();
		$suma = $request->compromiso+$request->adaptabilidad+$request->comunicacion+$request->equipo+$request->liderazgo+$request->sobreponerse+$request->habilidades+$request->proactividad+$request->innovacion+$request->etica;
		$promedio = $suma/10;
		$evaltutor->compromiso = $request->compromiso;
		$evaltutor->adaptabilidad = $request->adaptabilidad;
		$evaltutor->comunicacion = $request->comunicacion;
		$evaltutor->equipo = $request->equipo;
		$evaltutor->liderazgo = $request->liderazgo;
		$evaltutor->sobreponerse = $request->sobreponerse;
		$evaltutor->habilidades = $request->habilidades;
		$evaltutor->proactividad = $request->proactividad;
		$evaltutor->innovacion = $request->innovacion;
		$evaltutor->etica = $request->etica;
		$evaltutor->promedio = $promedio;
        $evaltutor->comentarios = $request->comentarios;
        if ($request->certificadoTutor) {
        	$evaltutor->certificadoTutor = $request->certificadoTutor;
        }
        $evaltutor->save();
		return view("evalTutor.postformulario");
	}

	public function create(){
		$userId = Auth::id();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$empresa = Empresa::find($pasantia->idEmpresa);

		$evalTutor = new EvalTutor;
		$evalTutor->idEncuesta = $string = str_random(10);
		$evalTutor->idPasantia = $pasantia->idPasantia;
		$evalTutor->save();


		Mail::to($pasantia->correoJefe)->send(new ConfTutor($pasantia, $user, $empresa));
	}

	public function test(){
		$userId = Auth::id();
		$user = Auth::user();
		$pasantia = Pasantia::where('idAlumno', $userId)->first();
		$empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
		$evalTutor = new EvalTutor;
		$evalTutor->idEncuesta = $string = str_random(10);
		$evalTutor->idPasantia = $pasantia->idPasantia;
		$evalTutor->save();
		Mail::to($pasantia->correoJefe)->send(new EvalTutorMail($pasantia, $user, $empresa, $evalTutor));
		return "Correo enviado a " . $pasantia->correoJefe;
	}
}
