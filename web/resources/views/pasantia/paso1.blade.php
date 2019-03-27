@extends('layout')


@section('contenido')
<div class="container-fluid">
	<div class="row">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/inscripcion/0">Paso 0</a></li>
				<li class="breadcrumb-item active" aria-current="page">Paso 1</li>
				<li class="breadcrumb-item"><a href="#">Paso 2</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 3</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 4</a></li>
		  </ol>
		</nav>
	</div>
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 1: Requisitos académicos</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<div class="col-md-6">
			<div class="card text-white bg-success">
			  <div class="card-header">
			    <h2 class="text-center">Práctica Operaria</h2>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title text-center">Tu práctica operaria se encuentra aprobada.</h5>
			  </div>
			</div>
		</div>
	</div>
	<div class="row justify-content-md-center mb-5">
		<div class="col-md-6">
			<div class="card text-white bg-info">
			  <div class="card-header">
			    <h2 class="text-center">Malla</h2>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title text-center">Tu malla permite solamente pasantías part-time</h5>
			  </div>
			</div>
		</div>
	</div>
	<div class="row justify-content-md-center mb-5">
		<form method="post" action="{{ route('inscripcion.1.post') }}">
			@csrf
			<button type="submit" class="btn btn-primary">Continuar</button>
		</form>
	</div>
</div>
@endsection
