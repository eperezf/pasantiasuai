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
use App\Proyecto;
use App\EvalTutor;
use Auth;

class EvalTutorController extends Controller{
	public function show($id){
		$evaltutor = EvalTutor::where('idEncuesta',$id)->first();
		$proyecto = Proyecto::where('idProyecto', $evaltutor->idProyecto)->first();
		$pasantia = Pasantia::where('idPasantia', $proyecto->idPasantia)->first();
		$alumno = User::where('idUsuario', $pasantia->idAlumno)->first();
		if(!$evaltutor->certificadoTutor)
		{
			return view('evalTutor.formulario',[
				'id' => $id,
				'alumno'=>$alumno
			]);
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

	public function enviar($idAlumno){
		$user = User::where('idUsuario', $idAlumno)->first();
		$pasantia = Pasantia::where('idAlumno', $idAlumno)->first();
		$proyecto = Proyecto::where('idPasantia', $pasantia->idPasantia)->first();
		$empresa = Empresa::where('idEmpresa', $pasantia->idEmpresa)->first();
		$evalTutor = new EvalTutor;
		$evalTutor->idEncuesta = $string = str_random(10);
		$evalTutor->idProyecto = $proyecto->idProyecto;
		$evalTutor->save();

		Mail::to($pasantia->correoJefe)->send(new EvalTutorMail($pasantia, $user, $empresa, $evalTutor));
		return redirect('/profesor')->with('success', 'Correo enviado correctamente');
	}

	public function listado($idProyecto){
    $proyecto = Proyecto::where('idProyecto', $idProyecto)->first();
    $evaluaciones = EvalTutor::where('idProyecto', $proyecto->idProyecto)->get();
		$pasantia = Pasantia::where('idPasantia', $proyecto->idPasantia)->first();
		$alumno = User::where('idUsuario', $pasantia->idAlumno)->first();
    return view('evalTutor.listado', compact('evaluaciones'), compact('alumno'));
	}

	public function ver ($idEvaluacion){
		$evaluacion = EvalTutor::where('idEvalTutor', $idEvaluacion)->first();
		$proyecto = Proyecto::where('idProyecto', $evaluacion->idProyecto)->first();
		$pasantia = Pasantia::where('idPasantia', $proyecto->idPasantia)->first();
		$alumno = User::where('idUsuario', $pasantia->idAlumno)->first();

		return view('evalTutor.ver', compact('evaluacion'), compact('alumno'));
	}
}
