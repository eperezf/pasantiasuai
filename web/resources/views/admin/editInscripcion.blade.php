@extends('layout')

@section('contenido')
<!-- Permitir popovers en esta pagina -->
<script>
  $(function () { $('[data-toggle="popover"]').popover() })
</script>
@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
@if(session()->get('danger'))
			<div class="alert alert-danger">
				{{session()->get('danger')}}
			</div>
      @endif
      
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
	<!-- Seleccion pasos -->
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
          <form method="post" action="{{route('listadoInscripcion.updatePaso2', $datosPasantias['idPasantia'])}}">
            @csrf
				    @method('POST')
              <div class="form-group">
                  <label for="empresa">Empresa en la que trabajarás</label>
                  <select class="form-control" id="empresa" name="empresa" required>
                    @foreach ($empresas as $empresa)
                      <option value="{{$empresa->idEmpresa}}" 
                        @if ($datosPasantias['idEmpresa'] == $empresa->idEmpresa) selected @endif>
                        {{$empresa->nombre}}</option>
                    @endforeach 
                  </select>
                </div>
                <div class="form-group">
                  <label for="ciudad">Ciudad en la que harás la pasantía</label>
                  <input class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" value="{{$datosPasantias['ciudadPasantia']}}" required>
                </div>
                <div class="form-group">
                  <label for="pais">País en la que harás la pasantía</label>
                  <input class="form-control" id="pais" name="pais" placeholder="País" value="{{$datosPasantias['paisPasantia']}}" required>
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha en la que iniciarás tu pasantía</label>
                  <input class="form-control" type="date" name="fecha" id="fecha" value="{{$datosPasantias['fechaInicioPasantia']}}" required>
                </div>
                <div class="form-group">
                  <label for="horas">Horas semanales de trabajo</label>
                  <input type="number" class="form-control" id="horas" name="horas"  min="20" max="45" step="0.1" value="{{$datosPasantias['horasSemanalesPasantia']}}" required>
                </div>
                <div class="form-group">
                  <p>Tengo un familiar que trabaja en la empresa o es socio/dueño de esta</p>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pariente" id="pariente" value="0" @if ($datosPasantias['parienteEmpresaPasantia'] == 0) checked @endif required>
                    <label class="form-check-label" for="parienteno">No</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pariente" id="pariente" value="1" @if ($datosPasantias['parienteEmpresaPasantia'] == 1) checked @endif>
                    <label class="form-check-label" for="parientesi">Sí</label>
                  </div>
                </div>
                @if ($datosPasantias['parienteEmpresaPasantia'] == 1)
                <div class="form-check form-check-inline">
                  <label for="pais">Describa el parentesco, rol y relación de su pariente en la empresa</label>
                  <input class="form-control" id="rolPariente" name="rolPariente" placeholder="Ej.: Mi padre, subgerente de finanzas, no estará en mi misma área." value="{{$datosPasantias['rolParientePasantia']}}" @if ($datosPasantias['parienteEmpresaPasantia'] == 1) required @endif>
                </div>
                @else @endif
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paso2EditCheck">
                  Editar
                </button>
              <button type="button" class="btn btn-warning" onclick="document.getElementById('paso2Edit').style.display = 'none';">Cancelar</button>
                
                <!-- Modal -->
                <div class="modal fade" id="paso2EditCheck" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content"> 
                      <div class="modal-header bg-danger">
                        <h3 class="modal-title text-white">¡Atención!</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-center">
                        Usted esta a punto de editar el paso 2 del alumno: <p class="font-weight-bold">{{$datosPasantias['nombresUsuario']}} {{$datosPasantias['apellidoPaternoUsuario']}} {{$datosPasantias['apellidoMaternoUsuario']}}.</p>
                        <p class="text-center">
                        Si desea continuar con esta operacion, presione editar, de lo contrario, cierre esta ventana.
                        </p>
                      </div>
                      <div class="modal-footer">
                        <input type="submit"  value="Editar" class="btn btn-primary">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
          </form>
      </div>
  </div>

  <!-- Menu edit paso 3 -->
  <div class="row justify-content-md-center mt-2 mb-5" id="paso3Edit" style="display: none;">
      <div class="col-md-9 text-center">
          <form method="" action="" class="text-center">
				@csrf
				<div class="form-group">
			    <label for="email">Correo</label>
			    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="correo@empresa.com" value="{{$datosPasantias['correoJefePasantia']}}">
			  </div>
			  <div class="form-group">
			    <label for="nombre">Nombre</label>
			    <input class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{$datosPasantias['nombreJefePasantia']}}">
			  </div>
        <button type="submit" class="btn btn-primary">Editar</button>
        <button type="buttpn" class="btn btn-warning" onclick="document.getElementById('paso3Edit').style.display = 'none';">Cancelar</button>
      </form>
      
      </div>
  </div>

</div>

@endsection