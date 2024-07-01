<div class="modal fade" id="crearUsuario" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formUsuario">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title fw-bold">Crear Usuario</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">
				
					<div class="mb-3 row">
	
						<label for="usuario" class="col-md-2 col-xl-2 col-form-label fw-bold">Usuario <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre Usuario">
						</div>
	
						<label for="contrasena" class="col-md-2 col-xl-2 col-form-label fw-bold">Contraseña <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña">
						</div>
					</div>

					<div class="mb-3 row">
	
						<label for="name" class="col-md-2 col-xl-2 col-form-label fw-bold">Nombre <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
						</div>
	
						<label for="lastname" class="col-md-2 col-xl-2 col-form-label fw-bold">Apellidos <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellidos">
						</div>
					</div>

					<div class="mb-3 row">
	
						<label for="phone" class="col-md-2 col-xl-2 col-form-label fw-bold">Celular <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="phone" id="phone" placeholder="Celular">
						</div>

						<label for="mail" class="col-md-2 col-xl-2 col-form-label fw-bold">Correo <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="mail" id="mail" placeholder="Correo">
						</div>
					</div>
					
					<div class="mb-3 row">
	
						<label for="type_doc" class="col-md-2 col-xl-2 col-form-label fw-bold">Tipo Doc. <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<select class="form-select form-control especie" name="type_doc" id="type_doc">
								<option value="1">D.N.I</option>
								<option value="3">R.U.C.</option>
								<option value="2">Carnet de Extranjeria</option>
								<option value="4">Pasaporte</option>
							</select>
						</div>

						<label for="document" class="col-md-2 col-xl-2 col-form-label fw-bold">Documento <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="document" id="document" placeholder="Documento">
						</div>
					</div>

					<div class="mb-3 row">
	
						<label for="id_perfil" class="col-md-2 col-xl-2 col-form-label fw-bold">Perfil <span class="text-danger">*</span></label>
						<div class="col-md-10 col-xl-10">
							<select class="form-select form-control especie" name="id_perfil" id="id_perfil">
								<option value="1">Administrador</option>
								<option value="3">Veterinario</option>
								<option value="2">Recepcionista</option>
								<option value="4">Inventario</option>
							</select>
						</div>
					</div>

					<div class="mb-3 row">
						<label for="photo" class="col-md-2 col-xl-2 col-form-label fw-bold">Foto <span class="text-danger">*</span></label>
						<div class="col-md-10 col-xl-10">
							<input class="form-control" type="file" id="photo" name="photo">
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