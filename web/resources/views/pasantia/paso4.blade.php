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
			    <input class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto" required>
			  </div>
				<div class="form-group">
			    <label for="nombre">Area</label>
			    <input class="form-control" id="area" name="area" placeholder="Area del proyecto" required>
			  </div>
				<div class="form-group">
			    <label for="disciplina">Disciplina de ingeniería</label>
			    <select class="form-control" id="disciplina" name="disciplina" required>
			      <option value="1">1</option>
			      <option value="2">2</option>
			      <option value="3">3</option>
			      <option value="4">4</option>
			      <option value="5">5</option>
			    </select>
			  </div>
				<div class="form-group">
			    <label for="problematica">Visión</label>
			    <textarea class="form-control" id="problematica" name="problematica" rows="3" placeholder="Problemática del proyecto" value="{{$proyecto->problematica}}"required></textarea>
					<textarea class="form-control" id="objetivo" name="objetivo" rows="2" placeholder="Objetivo del proyecto" required></textarea>
					<textarea class="form-control" id="medidas" name="medidas" rows="2" placeholder="Medidas de desempeño" required></textarea>
					<textarea class="form-control" id="metodologia" name="metodologia" rows="2" placeholder="Metodología" required></textarea>
					<textarea class="form-control" id="planificacion" name="planificacion" rows="6" placeholder="Planificación" required></textarea>
			  </div>
				<button type="submit" class="btn btn-primary">Continuar</button>
			</form>
		</div>
	</div>
</div>
@endsection
