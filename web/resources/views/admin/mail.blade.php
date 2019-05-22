@extends('layout')

@section('title', 'Graficos')

@section('contenido')
<div class="row justify-content-md-center mb-5">
	<h1>Enviar correo de prueba</h1>
</div>
<div class="row justify-content-md-center mb-5">
	<div class="col-md-6">
		<form method="post" action="{{ route('mail.send')}}" enctype="multipart/form-data">
			@csrf
	    <button class="btn btn-primary">Enviar</button>
		</form>
	</div>
</div>
@endsection
