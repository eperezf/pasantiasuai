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
			<li class="list-group-item @if($statusPaso1==2)list-group-item-success @else list-group-item-danger @endif">@if($statusPaso2 == 2)<i class="fas fa-check"></i> Práctica operario aprobada. @else <class="fas fa-exclamation"></i> Práctica operario pendiente. @endif</li>
		  <li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Modalidad de práctica part-time.</i></li>
			@if($statusPaso2 == 2)
			<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Harás tu pasantía en la empresa {{$empresa->nombre}} en {{$pasantia->ciudad}}, {{$pasantia->pais}}.</li>
			<li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Comenzarás el {{$pasantia->fechaInicio}} trabajando {{$pasantia->horasSemanales}} horas semanales. </li>
			@else
			<li class="list-group-item list-group-item-warning"><i class="fas fa-exclamation"></i> No has completado todos los datos de la empresa.</li>
			@endif
			<li class="list-group-item list-group-item-success"><i class="fas fa-envelope"></i> Se ha enviado el correo a {{$pasantia->nombreJefe}} en {{$empresa->nombre}} pero todavía no lo ha respondido.</li>

		  <li class="list-group-item list-group-item-success"><i class="fas fa-check"></i> Tu proyecto está a la espera de aprobación.</li>
		</ul>
	</div>
</div>

@endsection
