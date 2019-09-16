@extends('layout')

@section('title', 'Administración')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Administración</li>
  </ol>
</nav>
<div class="row">
  <div class="col">
    <h1>Panel de administración</h1>
  </div>
</div>
<div class="row">
  <div class="col">
    <a href="/admin/listadoInscripcion" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Ver inscripciones</a>
    <a href="/admin/estadisticas" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Ver estadísticas</a>
    <a href="/empresas" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Ver empresas</a>
    <a href="/admin/importarlista" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Importar listado de alumnos autorizados</a>
    <a href="/admin/asignarProyectos" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Asignar profesores a proyectos</a>
  </div>

</div>

@endsection
