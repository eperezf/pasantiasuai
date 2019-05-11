@extends('layout')


@section('contenido')
<div class="container-fluid">
	@include('pasantia.pasos', ['statusPaso0'=>$statusPaso0, 'statusPaso1'=>$statusPaso1, 'statusPaso2'=>$statusPaso2, 'statusPaso3'=>$statusPaso3, 'statusPaso4'=>$statusPaso4])
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
		<div class="col-md-6">
			<div class="card text-white bg-danger">
			  <div class="card-header">
			    <h2 class="text-center">¡Atención!</h2>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title text-center">En caso de no querer hacer el tipo de pasantía ya asignada, debe comunicarse con Sandra Reyes</h5>
					<p class="card-text text-center">mail: 
					<a href="mailto:sandra.reyes@uai.cl">sandra.reyes@uai.cl</a></p>
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
