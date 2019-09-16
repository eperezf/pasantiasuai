@extends('layout')

@section('title', 'Mis alumnos')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('profesor.index')}}">Profesor</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="/evaluacion/listado/{{$alumno->idUsuario}}">Evaluaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Evaluación</li>
  </ol>
</nav>
<div class="row">
  <div class="col">
    <h2>Evaluación de desempeño</h2>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Alumno: {{$alumno->nombres}} {{$alumno->apellidoPaterno}} {{$alumno->apellidoMaterno}}</h4>
  </div>
</div>
<div class="row">
  <div class="col">
    
  </div>
</div>
@endsection
