@extends('layout')


@section('contenido')
<div class="container-fluid">
	<div class="row">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/inscripcion/0">Paso 0</a></li>
				<li class="breadcrumb-item"><a href="/inscripcion/1">Paso 1</a></li>
				<li class="breadcrumb-item active" aria-current="page">Paso 2</li>
				<li class="breadcrumb-item"><a href="#">Paso 3</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 4</a></li>
		  </ol>
		</nav>
	</div>
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 2: Registro de datos</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<form method="post" action="{{ route('inscripcion.2.post') }}">
			@csrf
			<button type="submit" class="btn btn-primary">Continuar</button>
		</form>
	</div>
</div>
@endsection
