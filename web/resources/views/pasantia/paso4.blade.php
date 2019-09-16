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
			    <input class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto" value="{{$proyecto->nombre}}">
			  </div>
				<div class="form-group">
			    <label for="nombre">Area</label>
			    <input class="form-control" id="area" name="area" placeholder="Area del proyecto" value="{{$proyecto->area}}">
			  </div>
				<div class="form-group">
					<label for="disciplina">Disciplina</label>
			    <input class="form-control" id="disciplina" name="disciplina" placeholder="Disciplina" value="{{$proyecto->disciplina}}">
			  </div>
				<div class="form-group">
			    <label for="problematica">Visión</label>
			    <textarea class="form-control mb-2" id="problematica" name="problematica" rows="3" placeholder="Problemática del proyecto" >{{$proyecto->problematica}}</textarea>
					<textarea class="form-control mb-2" id="objetivo" name="objetivo" rows="2" placeholder="Objetivo del proyecto">{{$proyecto->objetivo}}</textarea>
					<textarea class="form-control mb-2" id="medidas" name="medidas" rows="2" placeholder="Medidas de desempeño" >{{$proyecto->medidas}}</textarea>
					<textarea class="form-control mb-2" id="metodologia" name="metodologia" rows="2" placeholder="Metodología" >{{$proyecto->metodologia}}</textarea>
					<textarea class="form-control mb-2" id="planificacion" name="planificacion" rows="6" placeholder="Planificación" >{{$proyecto->planificacion}}</textarea>
			  </div>
				<button type="submit" class="btn btn-primary">Continuar</button>
			</form>
		</div>
	</div>
</div>
@endsection
