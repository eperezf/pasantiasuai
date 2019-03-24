@extends('layout')


@section('contenido')
<div class="container-fluid">
	@if(session()->get('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}
    </div><br />
  @endif
	<div class="row">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Paso 0</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 1</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 2</a></li>
				<li class="breadcrumb-item active" aria-current="page">Paso 3</li>
				<li class="breadcrumb-item"><a href="#">Paso 4</a></li>
		  </ol>
		</nav>
	</div>
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 3: Datos de tu supervisor</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<form method="post" action="{{ route('inscripcion.3.post') }}" class="text-center">
			@csrf
			<div class="form-group">
		    <label for="email">Correo</label>
		    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="correo@empresa.com">
		  </div>
		  <div class="form-group">
		    <label for="nombre">Nombre</label>
		    <input class="form-control" id="nombre" placeholder="Nombre">
		  </div>
			<button type="submit" class="btn btn-primary">Enviar correo de validación</button>
		</form>
	</div>
</div>
@endsection
