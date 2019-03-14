@extends('layout')

@section('title', 'Listado de empresas')

@section('contenido')
<div class="container">
	<div class="row">
		<h1>Listado de empresas</h1>
	</div>
	<div class="row">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Nombre</th>
		      <th scope="col">Rubro</th>
		      <th scope="col">Sitio Web</th>
					<th scope="col">Correo de contacto</th>
		    </tr>
		  </thead>
		  <tbody>
				@foreach($empresas as $empresa)
		    <tr>
		      <th scope="row">{{$empresa->idEmpresa}}</th>
		      <td>{{$empresa->nombre}}</td>
		      <td>{{$empresa->rubro}}</td>
		      <td><a href="http://{{$empresa->urlWeb}}">{{$empresa->urlWeb}}</a></td>
					<td>{{$empresa->correoContacto}}</td>
		    </tr>
				@endforeach
		  </tbody>
		</table>
	</div>
</div>
@endsection
