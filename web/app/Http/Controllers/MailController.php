<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
	public function index(){
		return view('admin.mail');
	}

	public function send(){
		$data = array('name'=>"Nombre prueba");
		Mail::send('mail.test', $data, function($message) {
         $message->to('eduperez@alumnos.uai.cl', 'Eduardo Pérez');
				 $message->subject('Correo de prueba');
         $message->from('pasantia.fic@uai.cl','Pasantías FIC');
      });
			echo "correo enviado.";

	}
}
