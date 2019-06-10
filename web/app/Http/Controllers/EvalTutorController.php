<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\AuthUsers;
use App\Pasantia;
use App\Empresa;
use Auth;

class EvalTutorController extends Controller{
	public function show($id){
		return view('evalTutor',['id' => $id]);
	}

	public function save(Request $request){
		//return redirect()->route('welcome');
	}
}