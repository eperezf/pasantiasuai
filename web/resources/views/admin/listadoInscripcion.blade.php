@extends('layout')

@section('title')

@section('contenido')

@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
<div class="row justify-content-md-center mb-5">
	<h1>Listado de inscripciones de pasantias</h1>
</div>

<div class="row">
	<div class="col-12">
		@include('admin.tablaInscripciones')
	</div>
</div>

@endsection