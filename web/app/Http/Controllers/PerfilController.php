<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
    //
    public function index(){
      $perfil = Auth::id();
      return view('perfil.index', compact('perfil'));
    }
}
