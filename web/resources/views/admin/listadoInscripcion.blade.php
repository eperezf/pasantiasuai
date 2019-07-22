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
	<a href="{{ route('tablaInscripciones.export') }}" class="btn btn-primary">Exportar a excel</a>
	<div class="table-responsive bootstrap-table">
		@include('admin.tablaInscripciones')
	</div>
</div>

@endsection