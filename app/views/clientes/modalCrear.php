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
	
						<label for="nombre" class="col-md-2 col-xl-2 col-form-label fw-bold">Nombre <span class="text-danger">*</span></label>
						<div class="col-md-10 col-xl-10">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Cliente">
						</div>
					</div>

					<div class="mb-3 row">
						<label for="descripcion" class="col-md-2 col-xl-2 col-form-label fw-bold">Descripción</label>
						<div class="col-md-10 col-xl-10">
							<textarea class="form-control validate" placeholder="Escribe una descripcion" id="descripcion" name="descripcion" rows="3"></textarea>
						</div>
					</div>
					
					<div class="mb-3 row">
						<label for="precio" class="col-md-2 col-xl-2 col-form-label fw-bold">Precio <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4">
							<input type="text" class="form-control" name="precio" id="precio" placeholder="precio">
						</div>
	
						<label for="citas" class="col-md-2 col-xl-2 col-form-label fw-bold">Para Citas <span class="text-danger">*</span></label>
						<div class="col-md-4 col-xl-4 d-flex align-items-center">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="citas" value="1" id="citas" >
							</div>
						</div>
					</div>
	
					<div class="mb-3 row">
						<label for="foto" class="col-md-2 col-xl-2 col-form-label fw-bold">Foto</label>
						<div class="col-md-10 col-xl-10">
							<input class="form-control" type="file" id="foto" name="foto">
	
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