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
			@foreach($pasantias as $pasantia)
				<tr>

				<!-- inicio loop informacion usuarios -->
				@foreach($usuarios as $usuario)
					@if ($pasantia->idAlumno == $usuario->idUsuario)
						<td>{{$usuario->rut}}</td>
						<td>{{$usuario->nombres}} {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}}</td>
					@else
					@endif
				@endforeach
				<!-- fin loop informacion usuarios -->

				<td>{{$pasantia->fechaInicio}}</td>
				<td>{{$pasantia->horasSemanales}}</td>
				<td>{{$pasantia->ciudad}}</td>
				<td>{{$pasantia->pais}}</td>
				<!-- Paso 0 -->
				<td>
					@if ($pasantia->statusPaso0 == 2) Reglamento aceptado
					@elseif ($pasantia->statusPaso0 != 2) Reglamento aún no aceptado
					@else @endif
				</td>
				<!-- Paso 1 -->
				<td>
					@if ($pasantia->statusPaso1 == 2) Cumple requerimientos académicos
					@elseif ($pasantia->statusPaso1 != 2) No cumple todos los requerimientos académicos
					@else @endif
				</td>
				<!-- Paso 2 -->
				<td>
					@if ($pasantia->statusPaso2 == 1) Datos incompletos
					@elseif ($pasantia->statusPaso2 == 2) Completado y validado
					@elseif ($pasantia->statusPaso2 == 3) Pendiente por pariente
					@else No ha iniciado el paso 2 @endif
				</td>
				<!-- Paso 3 -->
				<td>
					@if ($pasantia->statusPaso3 == 0) No realizado
					@elseif ($pasantia->statusPaso3 == 1) Datos incompletos
					@elseif ($pasantia->statusPaso3 == 2) Correo no enviado
					@elseif ($pasantia->statusPaso3 == 3) Correo no confirmado
					@elseif ($pasantia->statusPaso3 == 4) Correo confirmado
					@else @endif
				</td>
				<!-- Paso 4 -->
				<td>
					@if ($pasantia->statusPaso4 == 0) No realizado
					@elseif ($pasantia->statusPaso4 == 1) Datos incompletos
					@elseif ($pasantia->statusPaso4 == 2) No validado
					@elseif ($pasantia->statusPaso4 == 3) Validado
					@elseif ($pasantia->statusPaso4 == 4) Reprobado
					@else @endif
				</td>
				<!-- Status General -->
				<td>
					@if ($pasantia->statusGeneral == 0) Pasantía sin validar
					@elseif ($pasantia->statusGeneral == 1) Pasantia validada
					@else @endif
				</td>
				
				
				<td class="@if ($pasantia->statusPaso2 == 3) table-danger @else @endif">
					@if ($pasantia->statusPaso2 == 3)
					{{$pasantia->rolPariente}}
					@elseif ($pasantia->statusPaso2 == 2 && $pasantia->parienteEmpresa == 1)
					{{$pasantia->rolPariente}}
					@else Sin Pariente @endif
					<!-- boton solo si tiene pariente -->
					@if ($pasantia->parienteEmpresa == 1)
					<!-- ignorar boton por descarga hacia excel -->
					@if($downloadExcel == TRUE)
					@elseif ($downloadExcel == FALSE)
					<!-- boton validacion de pariente -->
						<a class="btn btn-primary" href="{{route('listadoInscripcion.validarPariente', ['id' => $pasantia->idPasantia, 'statusPaso2' => $pasantia->statusPaso2])}}" role="button">
							@if ($pasantia->statusPaso2 == 2) Invalidar pariente
							@else Validar pariente @endif
						@else @endif <!-- endif de "ignorar boton por descarga hacia excel" -->
						</a> 
						@else @endif <!-- endif de "boton solo si tiene pariente" -->
				</td>

					<!-- inicio loop informacion empresas -->
					@foreach($empresas as $empresa)
						@if ($pasantia->idEmpresa == $empresa->idEmpresa)
								<td @if ($empresa->status != 1) class="table-warning" @else @endif>
									{{$empresa->nombre}}
									<!-- Descarga excel -->
								@if($downloadExcel == TRUE)
								@elseif ($downloadExcel == FALSE)
								<!-- Boton accion empresa -->
									<a class="btn btn-primary" href="{{route('listadoInscripcion.validarEmpresa', ['id' => $empresa->idEmpresa, 'statusEmpresa' => $empresa->status])}}" role="button">
									@if ($empresa->status == 1) Desactivar convenio
									@else Activar convenio @endif
								@else @endif
								</td>
							<td>{{$empresa->rubro}}</td>
						@else
						@endif
					@endforeach
					<!-- fin loop informacion empresas -->
					@if($downloadExcel == TRUE)
					@elseif ($downloadExcel == FALSE)
					<td>
						<a role="button" href="{{route('listadoInscripcion.validarTodo', ['idEmpresa' => $empresa->idEmpresa, 'idPasantia' => $pasantia->idPasantia])}}" class="btn btn-primary @if ($empresa->status == 1 && $pasantia->statusPaso2 == 2) disabled @else @endif">Validar todo</a>
						<a class="btn btn-warning disabled" href="{{route('listadoInscripcion.edit', $pasantia->idPasantia)}}" role="button">Editar</a>
						<form style="display: inline-block;" action="{{ route('listadoInscripcion.destroy', $pasantia->idPasantia)}}" method="post">
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