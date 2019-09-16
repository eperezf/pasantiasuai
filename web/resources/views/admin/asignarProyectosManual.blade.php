@extends('layout')

@section('title', 'Asignar proyectos')

@section('contenido')
<div class="row">
  <div class="col">
    <h1>Asignación manual</h1>
    <h4>Usted está asignando los proyectos al profesor {{$profesor->nombres}} {{$profesor->apellidoPaterno}}</h4>
    <a href="{{ route('admin.asignarProyectos') }}" class="btn btn-primary mb-2" role="button" aria-pressed="true">Volver al menu anterior</a>

  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Listado de proyectos sin asignación</h4>
    @foreach($proyectos as $proyecto)
    @if($proyecto->idProfesor == null)
    <div class="card">
      <div class="card-body">
        <h6>"{{$proyecto->nombre}}"</h6>
        <p>Alumno: {{$proyecto->alumno->nombres}} {{$proyecto->alumno->apellidoPaterno}}</p>
        <p>Correo: {{$proyecto->alumno->email}}</p>
        <a href="/admin/asignarProyectos/{{$profesor->idUsuario}}/{{$proyecto->idProyecto}}/agregar" class="btn btn-success mb-2" role="button" aria-pressed="true">Asignar</a>
      </div>
    </div>
    @endif
    @endforeach
  </div>
  <div class="col">
    <h4>listado de proyectos asignados a {{$profesor->nombres}}</h4>
    @foreach($proyectos as $proyecto)
    @if($proyecto->idProfesor == $profesor->idUsuario)
    <div class="card">
      <div class="card-body">
        <h6>"{{$proyecto->nombre}}"</h6>
        <p>Alumno: {{$proyecto->alumno->nombres}} {{$proyecto->alumno->apellidoPaterno}}</p>
        <p>Correo: {{$proyecto->alumno->email}}</p>
        <a href="/admin/asignarProyectos/{{$profesor->idUsuario}}/{{$proyecto->idProyecto}}/eliminar" class="btn btn-danger mb-2" role="button" aria-pressed="true">Remover</a>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</div>
@endsection
