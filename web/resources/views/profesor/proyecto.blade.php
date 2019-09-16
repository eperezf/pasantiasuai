@extends('layout')

@section('title', 'Mis alumnos')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('profesor.index')}}">Profesor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Proyecto</li>
  </ol>
</nav>
<div class="row">
  <div class="col">
    <h2>Visor de proyecto</h2>
  </div>
</div>
<div class="row">
  <div class="col">
    <h5>Está revisando el proyecto de {{$alumno->nombres}} {{$alumno->apellidoPaterno}} {{$alumno->apellidoMaterno}}</h5>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Nombre del proyecto:</h4>
    <p>{{$proyecto->nombre}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Area del proyecto:</h4>
    <p>{{$proyecto->area}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Disciplina:</h4>
    <p>{{$proyecto->disciplina}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Problemática:</h4>
    <p>{{$proyecto->problematica}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Objetivo:</h4>
    <p>{{$proyecto->objetivo}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Medidas:</h4>
    <p>{{$proyecto->medidas}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Metodología:</h4>
    <p>{{$proyecto->metodologia}}</p>
  </div>
</div>
<div class="row">
  <div class="col">
    <h4>Planificación:</h4>
    <p>{{$proyecto->planificacion}}</p>
  </div>
</div>

@endsection
