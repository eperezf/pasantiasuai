<table class="table table-hover w-auto" id="table" data-toggle="table" data-sortable="true" data-search="true"
			data-locale="es-CL">
			<thead>
				<tr>
					<th scope="col" data-field="rut" data-sortable="true">
						<div class="th-inner">RUT</div>
					</th>
					<th scope="col" data-field="nombreAlumno" data-sortable="true">
						<div class="th-inner">Nombre alumno</div>
					</th>
					<th scope="col" data-field="email" data-sortable="true">
						<div class="th-inner">Email</div>
					</th>
					<th scope="col" data-field="carrera" data-sortable="true">
						<div class="th-inner">Carrera</div>
					</th>
					<th scope="col" data-field="statusPregrado" data-sortable="true">
						<div class="th-inner">Status pregrado</div>
					</th>
					<th scope="col" data-field="fechaInicio" data-sortable="true">
						<div class="th-inner">Fecha inicio</div>
					</th>
					<th scope="col" data-field="horasSemanales" data-sortable="true">
						<div class="th-inner">Horas semanales</div>
					</th>
					<th scope="col" data-field="ciudad" data-sortable="true">
						<div class="th-inner">Ciudad</div>
					</th>
					<th scope="col" data-field="pais" data-sortable="true">
						<div class="th-inner">País</div>
					</th>
					<th scope="col" data-field="statuspaso0" data-sortable="true">
						<div class="th-inner">Estado paso 0</div>
					</th>
					<th scope="col" data-field="statuspaso1" data-sortable="true">
						<div class="th-inner">Estado paso 1</div>
					</th>
					<th scope="col" data-field="statuspaso2" data-sortable="true">
						<div class="th-inner">Estado paso 2</div>
					</th>
					<th scope="col" data-field="statuspaso3" data-sortable="true">
						<div class="th-inner">Estado paso 3</div>
					</th>
					<th scope="col" data-field="statuspaso4" data-sortable="true">
						<div class="th-inner">Estado paso 4</div>
					</th>
					<th scope="col" data-field="statusGeneral" data-sortable="true">
						<div class="th-inner">Status General</div>
					</th>
					<th scope="col" data-field="rolPariente">
						<div class="th-inner">Familiar</div>
					</th>
					<th scope="col" data-field="status" data-sortable="true">
						<div class="th-inner">Empresa en convenio</div>
					</th>
					<th scope="col" data-field="rubro">
						<div class="th-inner">Rubro</div>
					</th>
					@if($downloadExcel == TRUE)
					@elseif ($downloadExcel == FALSE)
					<th scope="col" data-field="acciones">
						<div class="th-inner">Acciones</div>
					</th>
					@else @endif
				</tr>
			</thead>
			<tbody>
			
			@foreach($datosPasantias as $datosPasantia)
				<tr>
				<!-- Datos: arr['key'] -->

				<!-- Datos Usuario -->
					<td>{{$datosPasantia['rutUsuario']}}</td>
					<td>
						{{$datosPasantia['nombresUsuario']}} 
						{{$datosPasantia['apellidoPaternoUsuario']}} 
						{{$datosPasantia['apellidoMaternoUsuario']}}
					</td>
					<td>{{$datosPasantia['emailUsuario']}}</td>
					<td>{{$datosPasantia['idCarreraUsuario']}}</td>
					<td>{{$datosPasantia['statusPregradoUsuario']}}</td>

					<!-- Datos Pasantia -->
					<td>{{$datosPasantia['fechaInicioPasantia']}}</td>
					<td>{{$datosPasantia['horasSemanalesPasantia']}}</td>
					<td>{{$datosPasantia['ciudadPasantia']}}</td>
					<td>{{$datosPasantia['paisPasantia']}}</td>
					<!-- Paso 0 -->
					<td>
						@if ($datosPasantia['statusPaso0Pasantia'] == 2) Reglamento aceptado
						@elseif ($datosPasantia['statusPaso0Pasantia'] != 2) Reglamento aún no aceptado
						@else @endif
					</td>
					<!-- Paso 1 -->
					<td>
						@if ($datosPasantia['statusPaso1Pasantia'] == 2) Cumple requerimientos académicos
						@elseif ($datosPasantia['statusPaso1Pasantia'] != 2) No cumple todos los requerimientos académicos
						@else @endif
					</td>
					<!-- Paso 2 -->
					<td>
						@if ($datosPasantia['statusPaso2Pasantia'] == 1) Datos incompletos
						@elseif ($datosPasantia['statusPaso2Pasantia'] == 2) Completado y validado
						@elseif ($datosPasantia['statusPaso2Pasantia'] == 3) Pendiente por pariente
						@else No ha iniciado el paso 2 @endif
					</td>
					<!-- Paso 3 -->
					<td>
						@if ($datosPasantia['statusPaso3Pasantia'] == 0) No realizado
						@elseif ($datosPasantia['statusPaso3Pasantia'] == 1) Datos incompletos
						@elseif ($datosPasantia['statusPaso3Pasantia'] == 2) Correo no enviado
						@elseif ($datosPasantia['statusPaso3Pasantia'] == 3) Correo no confirmado
						@elseif ($datosPasantia['statusPaso3Pasantia'] == 4) Correo confirmado
						@else @endif
					</td>
					<!-- Paso 4 -->
					<td>
						@if ($datosPasantia['statusPaso4Pasantia'] == 0) No realizado
						@elseif ($datosPasantia['statusPaso4Pasantia'] == 1) Datos incompletos
						@elseif ($datosPasantia['statusPaso4Pasantia'] == 2) No validado
						@elseif ($datosPasantia['statusPaso4Pasantia'] == 3) Validado
						@elseif ($datosPasantia['statusPaso4Pasantia'] == 4) Rechazado
						@else @endif

						@if($downloadExcel == TRUE)
						@elseif ($downloadExcel == FALSE)
						<!-- boton validacion de paso 4 -->
						@if ($datosPasantia['statusPaso4Pasantia'] == 2)
							<a class="btn btn-primary" href="{{route('listadoInscripcion.validarProyecto', 
							['id' => $datosPasantia['idPasantia'], 
							'accion' => 'Validar'])}}" role="button">
								Validar proyecto
							</a>
							<a class="btn btn-primary" href="{{route('listadoInscripcion.validarProyecto', 
							['id' => $datosPasantia['idPasantia'], 
							'accion' => 'Rechazar'])}}" role="button">
								Rechazar proyecto
							</a>
						@else @endif <!-- endif de botones de accion hacia el paso 4 de la pasantia -->
						@else @endif <!-- endif de "ignorar boton por descarga hacia excel" -->
					</td>
					<!-- Status General -->
					<td>
						@if ($datosPasantia['statusGeneralPasantia'] == 0) Pasantía sin validar
						@elseif ($datosPasantia['statusGeneralPasantia'] == 1) Pasantia validada
						@else @endif
					</td>
				
				
					<td class="@if ($datosPasantia['statusPaso2Pasantia'] == 3) table-danger @else @endif">
						@if ($datosPasantia['statusPaso2Pasantia'] == 3)
							{{$datosPasantia['rolParientePasantia']}}
						@elseif ($datosPasantia['statusPaso2Pasantia'] == 2 && $datosPasantia['parienteEmpresaPasantia'] == 1)
							{{$datosPasantia['rolParientePasantia']}}
						@else Sin Pariente @endif
						<!-- boton solo si tiene pariente -->
						@if ($datosPasantia['parienteEmpresaPasantia'] == 1)
						<!-- ignorar boton por descarga hacia excel -->
						@if($downloadExcel == TRUE)
						@elseif ($downloadExcel == FALSE)
						<!-- boton validacion de pariente -->
							<a class="btn btn-primary" href="{{route('listadoInscripcion.validarPariente', 
							['id' => $datosPasantia['idPasantia'], 
							'statusPaso2' => $datosPasantia['statusPaso2Pasantia']])}}" 
							role="button">
								@if ($datosPasantia['statusPaso2Pasantia'] == 2) Invalidar pariente
								@else Validar pariente @endif
							</a>
							@else @endif <!-- endif de "ignorar boton por descarga hacia excel" --> 
							@else @endif <!-- endif de "boton solo si tiene pariente" -->
					</td>

					<td @if ($datosPasantia['statusEmpresa'] != 1) class="table-warning" @else @endif>
						{{$datosPasantia['nombreEmpresa']}}
						<!-- Descarga excel -->
						@if($downloadExcel == TRUE)
						@elseif ($downloadExcel == FALSE)
						<!-- Boton accion empresa -->
							<a class="btn btn-primary" href="{{route('listadoInscripcion.validarEmpresa',
							['id' => $datosPasantia['idEmpresa'], 
							'statusEmpresa' => $datosPasantia['statusEmpresa']])}}" role="button">
								@if ($datosPasantia['statusEmpresa'] == 1) Desactivar convenio
								@else Activar convenio @endif
							</a>
						@else @endif
					</td>

					<td>{{$datosPasantia['rubroEmpresa']}}</td>
					@if($downloadExcel == TRUE)
					@elseif ($downloadExcel == FALSE)
					<td>
						<a role="button" href="{{route('listadoInscripcion.validarTodo', 
						['idEmpresa' => $datosPasantia['idEmpresa'], 
						'idPasantia' => $datosPasantia['idPasantia']])}}" class="btn btn-primary 
						@if ($datosPasantia['statusEmpresa'] == 1 && $datosPasantia['statusPaso2Pasantia'] == 2) 
						disabled @else @endif">Validar todo</a>

						<a class="btn btn-warning disabled" href="{{route('listadoInscripcion.edit', $datosPasantia['idPasantia'])}}" role="button">Editar</a>
						<form style="display: inline-block;" action="{{ route('listadoInscripcion.destroy', $datosPasantia['idPasantia'])}}" method="post">
	            @csrf
	            @method('DELETE')
	            <button class="btn btn-danger" type="submit">Eliminar</button>
	          </form>
					</td>
					@else @endif
				</tr>
				@endforeach
			</tbody>
		</table>