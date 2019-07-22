<table class="table table-hover" id="table" data-toggle="table" data-sortable="true" data-search="true"
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
					<th scope="col" data-field="pais" data-sortable="true">
						<div class="th-inner">País</div>
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
				<td>{{$pasantia->pais}}</td>
				@if ($pasantia->parienteEmpresa == 1)
					<td @if ($pasantia->statusPaso2 == 1) class="table-danger" @else @endif>
						{{$pasantia->rolPariente}}

						@if($downloadExcel == TRUE)
						@elseif ($downloadExcel == FALSE)
							<a class="btn btn-primary" href="{{route('listadoInscripcion.validarPariente', ['id' => $pasantia->idPasantia, 'statusPasantia' => $pasantia->statusPaso2])}}" role="button">
								@if ($pasantia->statusPaso2 == 2) Invalidar pariente
								@else Validar pariente @endif
							@else @endif

						</a> 
					</td>
				@elseif ($pasantia->parienteEmpresa == 0)
					<td>Sin Pariente</td>
				@else
				@endif

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
						<a class="btn btn-warning" href="{{route('listadoInscripcion.edit', $pasantia->idPasantia)}}" role="button">Editar</a>
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