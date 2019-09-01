@extends('layout')

@section('contenido')
<!-- Permitir popovers en esta pagina -->
<script>
  $(function () { $('[data-toggle="popover"]').popover() })
</script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-8">
			@if ($errors->any())
	      <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	              <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	      </div><br/>
	    @endif
			<h2 class="mt-4">Editando pasantia de alumno {{$datosPasantias['nombresUsuario']}} {{$datosPasantias['apellidoPaternoUsuario']}} {{$datosPasantias['apellidoMaternoUsuario']}}</h2>
		</div>
	</div>
	<!-- Seleccion titulo -->
	<div class="row justify-content-center">
		<div class="col-8">
			<h3 class="my-4">Seleccione un paso para editar</h3>
		</div>
	</div>
	<!-- BOTONES RESUMEN -->
	<div class="row justify-content-md-center mt-2 mb-5">
	<div class="col-md-9 text-center">
		<a tabindex="0"  class="btn btn-lg btn-outline-@if($datosPasantias['statusPaso0Pasantia'] =='2')success @else{{'secondary'}} @endif" role="button" data-placement="bottom"
   data-html="true" 
   data-toggle="popover" 
   data-trigger="focus" 
   title="<b>Acción</b>" 
   data-content="<a class='btn btn-warning' href='' role='button'>Editar</a> <a class='btn btn-danger' href='' role='button'>Eliminar</a>">Paso 0 @if($datosPasantias['statusPaso0Pasantia'] =='2')<i class="fas fa-check"></i>@else @endif</a>
		<a tabindex="0"  class="btn btn-lg btn-outline-@if($datosPasantias['statusPaso1Pasantia'] =='2')success @else{{'secondary'}} @endif" role="button" data-placement="bottom"
   data-html="true" 
   data-toggle="popover" 
   data-trigger="focus" 
   title="<b>Acción</b>" 
   data-content="<a class='btn btn-warning' href='' role='button'>Editar</a> <a class='btn btn-danger' href='' role='button'>Eliminar</a>">Paso 1 @if($datosPasantias['statusPaso1Pasantia'] =='2')<i class="fas fa-check"></i>@else @endif</a>
		<a tabindex="0"  class="btn btn-lg btn-outline-@if($datosPasantias['statusPaso2Pasantia'] =='2')success @elseif($datosPasantias['statusPaso2Pasantia'] =='1' || $datosPasantias['statusPaso2Pasantia'] =='3')warning @else{{'secondary'}}@endif" role="button" data-placement="bottom"
   data-html="true" 
   data-toggle="popover" 
   data-trigger="focus" 
   title="<b>Acción</b>" 
   data-content="<a class='btn btn-warning' href='' role='button'>Editar</a> <a class='btn btn-danger' href='' role='button'>Eliminar</a>">Paso 2 @if($datosPasantias['statusPaso2Pasantia'] =='2')<i class="fas fa-check"></i>@elseif($datosPasantias['statusPaso2Pasantia'] =='1' || $datosPasantias['statusPaso2Pasantia'] =='3')<i class="fas fa-exclamation"></i>@else <i class="fas fa-question"></i>@endif</a>
		<a tabindex="0"  class="btn btn-lg btn-outline-@if($datosPasantias['statusPaso3Pasantia'] =='2' ||$datosPasantias['statusPaso3Pasantia'] =='3' || $datosPasantias['statusPaso3Pasantia'] =='4')success @elseif($datosPasantias['statusPaso2Pasantia'] =='1')warning @else{{'secondary'}}@endif" role="button" data-placement="bottom"
   data-html="true" 
   data-toggle="popover" 
   data-trigger="focus" 
   title="<b>Acción</b>" 
   data-content="<a class='btn btn-warning' href='' role='button'>Editar</a> <a class='btn btn-danger' href='' role='button'>Eliminar</a>">Paso 3 @if($datosPasantias['statusPaso3Pasantia'] =='4')<i class="fas fa-envelope-open"></i>@elseif($datosPasantias['statusPaso3Pasantia'] =='3')<i class="fas fa-envelope"></i>@elseif($datosPasantias['statusPaso3Pasantia'] =='2')<i class="fas fa-check"></i>@elseif($datosPasantias['statusPaso3Pasantia'] =='1')<i class="fas fa-exclamation"></i>@else <i class="fas fa-question"></i>@endif</a>
		<a tabindex="0"  class="btn btn-lg btn-outline-@if($datosPasantias['statusPaso4Pasantia'] =='0')secondary @elseif($datosPasantias['statusPaso4Pasantia'] =='1')warning @elseif($datosPasantias['statusPaso4Pasantia'] =='2')success @else{{'success'}}@endif" role="button" data-placement="bottom"
   data-html="true" 
   data-toggle="popover" 
   data-trigger="focus" 
   title="<b>Acción</b>" 
   data-content="<a class='btn btn-warning' href='' role='button'>Editar</a> <a class='btn btn-danger' href='' role='button'>Eliminar</a>">Paso 4 </a>
	</div>
</div>



</div>

@endsection