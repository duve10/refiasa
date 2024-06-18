<div class="modal fade" id="crearMascota" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title fw-bold">Crear Mascota</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3">
				<div class="mb-3 row">
					<label for="id_cliente" class="col-md-2 col-xl-2 col-form-label fw-bold">Cliente <span class="text-danger">*</span></label>
					<div class="col-md-10 col-xl-10">
						<select class="form-control id_cliente" name="id_cliente" id="id_cliente"></select>
					</div>
				</div>
				<div class="mb-3 row">

					<label for="nombre" class="col-md-2 col-xl-2 col-form-label fw-bold">Nombre <span class="text-danger">*</span></label>
					<div class="col-md-10 col-xl-10">
						<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Mascota">
					</div>
				</div>

				<div class="mb-3 row">
					<label for="peso" class="col-md-2 col-xl-2 col-form-label fw-bold">Peso (Kg) <span class="text-danger">*</span></label>
					<div class="col-md-4 col-xl-4">
						<input type="text" class="form-control" name="peso" id="peso" placeholder="Peso">
					</div>

					<label for="altura" class="col-md-2 col-xl-2 col-form-label fw-bold">Altura (m) <span class="text-danger">*</span></label>
					<div class="col-md-4 col-xl-4">
						<input type="text" class="form-control" name="altura" id="altura" placeholder="Altura">
					</div>
				</div>

				<div class="mb-3 row">
					<label for="especie" class="col-md-2 col-xl-2 col-form-label fw-bold">Especie <span class="text-danger">*</span></label>
					<div class="col-md-4 col-xl-4">
						<select class="form-select form-control especie" name="especie" id="especie">
							<option value="">Especie</option>
							<?php foreach ($especies as $especie) : ?>
								<option value="<?= $especie['id'] ?>"><?= $especie['nombre'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<label for="raza" class="col-md-2 col-xl-2 col-form-label fw-bold">Raza <span class="text-danger">*</span></label>
					<div class="col-md-4 col-xl-4">
						<select class="form-select form-control raza" name="raza" id="raza">
							<option value="">Raza</option>
						</select>
					</div>
				</div>

				<div class="mb-3 row">
					<label for="fecha_nac" class="col-md-2 col-xl-2 col-form-label fw-bold">Fecha Nac. <span class="text-danger">*</span></label>
					<div class="col-md-4 col-xl-4">
						<input type="text" class="form-control w-100" name="fecha_nac" id="fecha_nac" value="<?= date("d-m-Y")  ?>">
					</div>
					<label for="sexo" class="col-md-2 col-xl-2 col-form-label fw-bold">Sexo <span class="text-danger">*</span></label>
					<div class="col-md-4 col-xl-4">
						<select class="form-select form-control sexo" name="sexo" id="sexo">

							<option value="M">Macho</option>
							<option value="F">Hembra</option>
						</select>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="foto" class="col-md-2 col-xl-2 col-form-label fw-bold">Foto</label>
					<div class="col-md-10 col-xl-10">
						<input class="form-control" type="file" id="foto" name="foto">

					</div>
				</div>
				<div class="mb-3 row">
					<label for="comentario" class="col-md-2 col-xl-2 col-form-label fw-bold">Comentario</label>
					<div class="col-md-10 col-xl-10">
						<textarea class="form-control validate" placeholder="Escribe un comentario" id="comentario" name="comentario" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>