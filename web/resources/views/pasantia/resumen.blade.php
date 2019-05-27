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
		<h2>Resumen de tu inscripción</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<ul class="list-group">
			@if($statusPaso0 == 2)
				<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Has aceptado el reglamento de pasantías.</li>
			@else
				<li class="list-group-item list-group-item-warning"><i class="fas fa-exclamation"></i> Todavía no has aceptado el reglamento de pasantías.</li>
			@endif

			@if($statusPaso1 == 2)
				<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Ya has completado tu práctica operario.</li>
			@else
				<li class="list-group-item list-group-item-warning"><i class="fas fa-exclamation"></i> Debes realizar tu práctica operario antes de realizar la pasantía</li>
			@endif

			@if($statusPaso2 == 2)
				<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Trabajarás en la empresa {{$empresa->nombre}} en {{$pasantia->ciudad}}, {{$pasantia->pais}}.</li>
				<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Comenzarás el {{$pasantia->fechaInicio}} trabajando {{$pasantia->horasSemanales}} horas semanales. </li>
			@elseif($statusPaso2 == 1)
				<li class="list-group-item list-group-item-warning"><i class="fas fa-exclamation"></i> Faltan uno o más datos del paso 2.</li>
			@else
				<li class="list-group-item list-group-item-warning"><i class="fas fa-exclamation"></i> No has iniciado el paso 2.</li>
			@endif

			@if($statusPaso3==3)
				<li class="list-group-item list-group-item-success"><i class="fas fa-envelope-open"></i> Tu supervisor, {{$pasantia->nombreJefe}}, ha confirmado su correo.</li>
			@elseif($statusPaso3==2)
				<li class="list-group-item list-group-item-success"><i class="fas fa-envelope"></i> Tu supervisor, {{$pasantia->nombreJefe}}, ha recibido el correo pero no lo ha confirmado.</li>
			@elseif($statusPaso3==1)
				<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Tienes guardados los datos de tu supervisor, {{$pasantia->nombreJefe}}.</li>
			@else
				<li class="list-group-item list-group-item-warning"><i class="fas fa-exclamation"></i> No has iniciado el paso 3.</li>
			@endif
		</ul>
	</div>
	@if(Auth::user()->rol >= 4)
	<div class="row justify-content-md-center mb-5">
		<form style="display: inline-block;" action="{{ url('inscripcion/destroy', $pasantia->idPasantia)}}" method="post">
			@csrf
			@method('DELETE')
			<button class="btn btn-danger" type="submit">Eliminar</button>
				</form>
	</div>
	@endif
</div>
@endsection
