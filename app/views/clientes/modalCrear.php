<div class="modal fade" id="crearCliente" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formCliente">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title fw-bold">Crear Cliente</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">

					<div class="mb-3 row">
						<label for="razon" class="col-md-2 col-xl-2 col-form-label fw-bold">Razon Social <span class="text-danger">*</span></label>
						<div class="col-md-10 col-xl-10">
							<input type="text" class="form-control" name="razon" id="razon" placeholder="Razon Social">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="nombre" class="col-md-2 col-xl-2 col-form-label fw-bold">Nombre <span class="text-danger">*</span></label>
						<div class="col-md-10 col-xl-10">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Cliente">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="apellido_paterno" class="col-md-2 col-xl-2 col-form-label fw-bold">Ap. Paterno <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno">
						</div>

						<label for="apellido_materno" class="col-md-2 col-xl-2 col-form-label fw-bold">Ap. Materno <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="tipo_documento_id" class="col-md-2 col-xl-2 col-form-label fw-bold">Tipo Documento <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<select class="form-select form-control tipo_documento_id" name="tipo_documento_id" id="tipo_documento_id">
								<option value="1">D.N.I.</option>
								<option value="2">C.E.</option>
								<option value="3">R.U.C.</option>
								<option value="4">Pasaporte</option>
							</select>
						</div>

						<label for="documento" class="col-md-2 col-xl-2 col-form-label fw-bold">Documento <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="documento" id="documento" placeholder="Documento">
						</div>
					</div>

					<div class="mb-3 row">
						<label for="direccion" class="col-md-2 col-xl-2 col-form-label fw-bold">Direccion</label>
						<div class="col-md-10 col-xl-10">
							<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion">
						</div>
					</div>

					<div class="mb-3 row">
						<label for="telefono" class="col-md-2 col-xl-2 col-form-label fw-bold">Telefono</label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
						</div>

						<label for="correo" class="col-md-2 col-xl-2 col-form-label fw-bold">Correo</label>
						<div class="col-md-4 col-xl-4">
							<input type="mail" class="form-control" name="correo" id="correo" placeholder="Correo">
						</div>
					</div>

					<div class="mb-3 row">
						<label for="fecha_nac" class="col-md-2 col-xl-2 col-form-label fw-bold">Fecha Nac. <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control w-100" name="fecha_nac" id="fecha_nac" value="<?= date("d-m-Y")  ?>">
						</div>
						<label for="sexo" class="col-md-2 col-xl-2 col-form-label fw-bold">Genero <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<select class="form-select form-control sexo" name="sexo" id="sexo">
	
								<option value="M">Masculino</option>
								<option value="F">Femenino</option>
							</select>
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</form>
	</div>
</div>