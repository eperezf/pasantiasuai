@extends('layout')

@section('title', 'Mis alumnos')

@section('contenido')
<div class="row">
  <div class="col">
    <h1>Panel de control de profesor</h1>
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
            <td>{{$proyecto->nombre}}</td>
            <td>
              <div class="btn-group dropleft">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Acciones
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="/evaluacion/enviar/{{$proyecto->alumno->idUsuario}}">Enviar evaluación de desempeño a supervisor</a>
                  <a class="dropdown-item" href="/evaluacion/listado/{{$proyecto->idProyecto}}">Revisar evaluaciones de desempeño</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Revisar datos del proyecto</a>
                  <a class="dropdown-item" href="#">Enviar correo al alumno</a>
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
