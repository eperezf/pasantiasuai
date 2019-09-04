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
	<!-- Botones acciones -->
	<div class="row justify-content-md-center mt-2 mb-5">
    <div class="col-md-9 text-center">
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle mx-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Paso 2
        </button>
        <div class="dropdown-menu">
          <p class="dropdown-header font-weight-bold">Acción</p>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><button class="btn btn-warning" type="button" onclick="document.getElementById('paso2Edit').style.display = 'block';">Editar</button></a>
          <a class="dropdown-item" href="#"><button class="btn btn-danger" type="button">Eliminar</button></a>
        </div>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle mx-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Paso 3
        </button>
        <div class="dropdown-menu">
          <p class="dropdown-header font-weight-bold">Acción</p>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><button class="btn btn-warning" type="button" onclick="document.getElementById('paso3Edit').style.display = 'block';">Editar</button></a>
          <a class="dropdown-item" href="#"><button class="btn btn-danger" type="button">Eliminar</button></a>
        </div>
      </div>
    </div>
  </div>

<!-- Menu edit paso 2 -->
  <div class="row justify-content-md-center mt-2 mb-5" id="paso2Edit" style="display: none;">
      <div class="col-md-9 text-center">
          <form method="" action="">


              <div class="form-group">
                  <label for="empresa">Empresa en la que trabajarás</label>
                  <select class="form-control" id="empresa" name="empresa">
                        <option value="{{$datosPasantias['nombreEmpresa']}}" selected>{{$datosPasantias['nombreEmpresa']}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ciudad">Ciudad en la que harás la pasantía</label>
                  <input class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                </div>
                <div class="form-group">
                  <label for="pais">País en la que harás la pasantía</label>
                  <input class="form-control" id="pais" name="pais" placeholder="País">
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha en la que iniciarás tu pasantía</label>
                  <input class="form-control" type="date" name="fecha" id="fecha">
                </div>
                <div class="form-group">
                  <label for="horas">Horas semanales de trabajo</label>
                  <input type="number" class="form-control" id="horas" name="horas"  min="20" max="45" step="0.1">
                </div>
                <div class="form-group">
                  <p>Tengo un familiar que trabaja en la empresa o es socio/dueño de esta</p>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pariente" id="pariente" value="0" >
                    <label class="form-check-label" for="parienteno">No</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pariente" id="pariente" value="1">
                    <label class="form-check-label" for="parientesi">Sí</label>
                  </div>
                </div>




              <button type="submit" class="btn btn-primary">Editar</button>
              <button type="buttpn" class="btn btn-warning" onclick="document.getElementById('paso2Edit').style.display = 'none';">Cancelar</button>
          </form>
      </div>
  </div>

  <!-- Menu edit paso 3 -->
  <div class="row justify-content-md-center mt-2 mb-5" id="paso3Edit" style="display: none;">
      <div class="col-md-9 text-center">
          <form method="" action="">



              <button type="submit" class="btn btn-primary">Editar</button>
              <button type="buttpn" class="btn btn-warning" onclick="document.getElementById('paso3Edit').style.display = 'none';">Cancelar</button>
          </form>
      </div>
  </div>

</div>

@endsection