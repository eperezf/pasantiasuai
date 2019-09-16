@extends('layout')

@section('title', 'Mis alumnos')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('profesor.index')}}">Profesor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Evaluaciones</li>
  </ol>
</nav>
<div class="row">
  <div class="col">
    <h1>Listado de evaluaciones</h1>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Alumno: {{$alumno->nombres}} {{$alumno->apellidoPaterno}} {{$alumno->apellidoMaterno}}</h4>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="table-responsive bootstrap-table">
			<table class="table" id="table" data-toggle="table" data-sortable="true" data-search="true" data-locale="es-CL">
			  <thead>
			    <tr>
            <th scope="col" data-field="alumno" data-sortable="true"><div class="th-inner">Fecha enviada</div></th>
			      <th scope="col" data-field="correo" data-sortable="true"><div class="th-inner">Respondida</div></th>
						<th scope="col" data-field="empresa" data-sortable="true"><div class="th-inner">Promedio</div></th>
						<th scope="col" data-field="acciones" data-sortable="false"><div class="th-inner">Acciones</div></th>
			    </tr>
			  </thead>
			  <tbody>
					@foreach($evaluaciones as $evaluacion)
			    <tr>
            <td>{{$evaluacion->created_at}}</td>
            <td>{{$evaluacion->certificadoTutor}}</td>
            <td>{{$evaluacion->promedio}}</td>
            <td>
              <div class="btn-group dropleft">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Acciones
                </button>
                <div class="dropdown-menu">
                  @if($evaluacion->certificadoTutor == 0)<a class="dropdown-item" href="/evaluacion/reenviar/{{$evaluacion->idEvaltutor}}">Reenviar evaluación</a>@endif
                  <a class="dropdown-item" href="/evaluacion/ver/{{$evaluacion->idEvalTutor}}">Revisar evaluación</a>
                </div>
              </div>
            </td>
			    </tr>
					@endforeach
			  </tbody>
			</table>
		</div>
  </div>

</div>

@endsection
