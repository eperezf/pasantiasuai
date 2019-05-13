@extends('layout')

@section('contenido')
<div class="container-fluid">
	@if(session()->get('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}
    </div><br />
  @endif
	@include('pasantia.pasos', ['statusPaso0'=>$statusPaso0, 'statusPaso1'=>$statusPaso1, 'statusPaso2'=>$statusPaso2, 'statusPaso3'=>$statusPaso3, 'statusPaso4'=>$statusPaso4])
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 4: Proyecto</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<div class="col-md-9">
			<form method="post" action="{{ route('inscripcion.4.post') }}" class="text-center">
				@csrf
				<div class="form-group">
			    <label for="nombre">Nombre</label>
			    <input class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto">
			  </div>
				<div class="form-group">
			    <label for="nombre">Area</label>
			    <input class="form-control" id="area" name="area" placeholder="Area del proyecto">
			  </div>
				<div class="form-group">
			    <label for="problematica">Problemática</label>
			    <textarea class="form-control" id="problematica" name="problematica" rows="3" placeholder="Problemática del proyecto"></textarea>
			  </div>
				<div class="form-group">
			    <label for="vision">Visión</label>
			    <textarea class="form-control" id="vision" name="vision" rows="5" placeholder="Vision del proyecto"></textarea>
			  </div>
				<button type="submit" class="btn btn-primary">Continuar</button>
			</form>
		</div>
	</div>
</div>
@endsection
