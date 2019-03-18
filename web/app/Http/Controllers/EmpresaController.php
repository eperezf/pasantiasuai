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
			if ($request->status == ""){
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
			'status'=>$request->get('status')
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    	$empresa = Empresa::find($id);
			return view('empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
