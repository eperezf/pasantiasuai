@extends('layout')

@section('title', 'Mis alumnos')

@section('contenido')
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
            <td>Nada por ahora</td>
			    </tr>
					@endforeach
			  </tbody>
			</table>
		</div>
  </div>

</div>

@endsection
