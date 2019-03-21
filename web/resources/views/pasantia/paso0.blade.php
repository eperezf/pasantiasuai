@extends('layout')


@section('contenido')
<div class="container-fluid">
	<div class="row">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item active" aria-current="page">Paso 0</li>
				<li class="breadcrumb-item"><a href="#">Paso 1</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 2</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 3</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 4</a></li>
		  </ol>
		</nav>
	</div>
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 0: Reglamento</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		aquí va el reglamento
	</div>
	<div class="row justify-content-md-center mb-5">
		<form method="post" action="{{ route('inscripcion.0.post') }}" class="text-center">
			@csrf
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="1" id="reglamento" name="reglamento">
			  <label class="form-check-label mb-2" for="reglamento">
			    He leído y acepto el reglamento de inscripción
			  </label>
			</div>
			<button type="submit" class="btn btn-primary">Continuar</button>
		</form>
	</div>
</div>
@endsection
