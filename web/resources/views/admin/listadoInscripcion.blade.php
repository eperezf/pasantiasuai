@extends('layout')

@section('title')

@section('contenido')
<div class="row justify-content-md-center mb-5">
	<h1>Listado de inscripciones de pasantias</h1>
</div>

<div class="row">
	<a href="{{ route('tablaInscripciones.export') }}" class="btn btn-primary">Exportar a excel</a>
	<div class="table-responsive bootstrap-table">
		@include('admin.tablaInscripciones', compact($usuarios, $pasantias, $empresas))
	</div>
</div>

@endsection