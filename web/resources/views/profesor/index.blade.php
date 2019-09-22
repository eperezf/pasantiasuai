@extends('layout')

@section('title', 'Mis alumnos')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Profesor</li>
  </ol>
</nav>
<div class="row">
  <div class="col">
    <h1>Panel de control de profesor</h1>
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{session()->get('success')}}
    </div>
    @endif
    @if(session()->get('warning'))
    <div class="alert alert-warning">
      {{session()->get('warning')}}
    </div>
    @endif
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="table-responsive bootstrap-table">
			<table class="table" id="table" data-toggle="table" data-sortable="true" data-search="true" data-locale="es-CL">
			  <thead>
			    <tr>
			      <th scope="col" data-field="alumno" data-sortable="true"><div class="th-inner">Alumno</div></th>
			      <th scope="col" data-field="correo" data-sortable="true"><div class="th-inner">Correo</div></th>
						<th scope="col" data-field="empresa" data-sortable="true"><div class="th-inner">Empresa</div></th>
			      <th scope="col" data-field="proyecto" data-sortable="true"><div class="th-inner">Proyecto</div></th>
						<th scope="col" data-field="acciones" data-sortable="false"><div class="th-inner">Acciones</div></th>
			    </tr>
			  </thead>
			  <tbody>
					@foreach($proyectos as $proyecto)
			    <tr>
            <td>{{$proyecto->alumno->nombres}} {{$proyecto->alumno->apellidoPaterno}}</td>
            <td>{{$proyecto->alumno->email}}</td>
            <td>{{$proyecto->empresa->nombre}}</td>
            <td>
              <p class="mb-1">{{$proyecto->nombre}}</p>
              <p>
                @if($proyecto->status == 1)
                <span class="badge badge-secondary">Incompleto</span>
                @elseif($proyecto->status == 2)
                <span class="badge badge-primary">A la espera de revisión</span>
                @elseif($proyecto->status == 3)
                <span class="badge badge-danger">Objetado</span>
                @elseif($proyecto->status == 4)
                <span class="badge badge-success">Aprobado</span>
                @endif
              </p>
            </td>
            <td>
              <div class="btn-group dropleft">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Acciones
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="/evaluacion/enviar/{{$proyecto->alumno->idUsuario}}"><i class="fas fa-envelope"></i> Enviar evaluación de desempeño a supervisor</a>
                  <a class="dropdown-item" href="/evaluacion/listado/{{$proyecto->idProyecto}}">Revisar evaluaciones de desempeño</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/profesor/proyecto/{{$proyecto->idProyecto}}">Revisar proyecto</a>
                  <a class="dropdown-item" href="mailto:{{$proyecto->alumno->email}}">Enviar correo al alumno</a>
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
