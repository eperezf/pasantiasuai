@extends('layout')

@section('title', 'Asignar alumnos')

@section('contenido')
<div class="row">
  <div class="col">
    <h1>Asignar profesores a proyectos:</h1>
  </div>
</div>
<div class="row">
  <div class="col">
    <h3>Importar listado Excel</h3>
  </div>
  <div class="col">
    <h3>Editar manualmente</h3>
    <h4>Profesores:</h4>
    @foreach ($profesores as $profesor)
    <a href="/admin/asignarProyectos/{{$profesor->idUsuario}}" class="btn btn-primary mb-2" role="button" aria-pressed="true">{{ $profesor->nombres }} {{$profesor->apellidoPaterno}} <span class="badge badge-light">{{$profesor->Proyectos}}</span></a>
    </br>
    @endforeach
    <p class="small">Si el profesor no aparece en la lista, este debe inicar sesión en la plataforma para aparecer</p>
  </div>
</div>

@endsection
