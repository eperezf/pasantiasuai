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

@endsection
