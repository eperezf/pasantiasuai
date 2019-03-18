<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller{
  /**
   * Muestra un listado de empresas
   * @return \Illuminate\Http\Response
   */
  public function index(){
		$empresas = Empresa::all();
  	return view('empresa.index', compact('empresas'));
  }

    /**
     * Muestra el formulario de creación de empresa
     * @return \Illuminate\Http\Response
     */
    public function create(){
      return view('empresa.create');
    }

    /**
     * Guarda la empresa en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
			if ($request->status == NULL){
				$request->status = 0;
			};

			$request->validate(
				['nombre'=>'required|unique:empresa'],
				['rubro'=>'required'],
				['urlWeb'=>'required'],
				['correoContacto'=>'required'],
				['status'=>'required']
			);

		$empresa = new Empresa([
			'nombre'=>$request->get('nombre'),
			'rubro'=>$request->get('rubro'),
			'urlWeb'=>$request->get('urlWeb'),
			'correoContacto'=>$request->get('correoContacto'),
			'status'=>$request->status
		]);
		$empresa->save();
		return redirect('/empresas')->with('success', 'Nueva empresa agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra el formulario de edición de empresa.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    	$empresa = Empresa::find($id);
			return view('empresa.edit', compact('empresa'));
    }

    /**
     * Actualiza la empresa especificada en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
			$request->validate(
				['nombre'=>'required'],
				['rubro'=>'required'],
				['urlWeb'=>'required'],
				['correoContacto'=>'required'],
				['status'=>'required']
			);
			if ($request->status == NULL){
				$request->status = 0;
			};
			$empresa = Empresa::find($id);
			$empresa->nombre = $request->get('nombre');
			$empresa->rubro = $request->get('rubro');
			$empresa->urlWeb = $request->get('urlWeb');
			$empresa->correoContacto = $request->get('correoContacto');
			$empresa->status = $request->status;
			$empresa->save();
			return redirect('/empresas')->with('success', 'Empresa editada correctamente');

    }

    /**
     * Elimina la empresa de la base de datos.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
			$empresa = Empresa::find($id);
			$empresa->delete();
			return redirect('/empresas')->with('success', 'Empresa eliminada correctamente');
    }
}
