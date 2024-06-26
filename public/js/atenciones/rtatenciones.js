document.addEventListener("DOMContentLoaded", (e) => {
  getAtenciones();
  iniciarFechaChange();
});

function iniciarFechaChange() {
  flatpickr(".fecha", {
    enableTime: false,
    dateFormat: "d-m-Y",
    minDate: "today",
    time_24hr: true,
    disableMobile: true,
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        let dateSelected = dateStr;
        getAtenciones(dateSelected);
      }
    },
  });
}

async function getAtenciones(fechaSelected = null) {
  let fecha = "";
  if (fechaSelected == null) {
    fecha = document.getElementById("fecha").value;
  } else {
    fecha = fechaSelected;
  }

  let listaAtenciones = document.getElementById("accordionAtencion");
  try {
    let response = await fetch(
      "../atenciones/apiGetTodayAtenciones?fecha=" + fecha,
      {
        method: "GET",
      }
    );

    let data = await response.json();
    let htmlAtencion = "";
    let verifyFirst = 0;
    let expanded = "true";
    let collapsed = "";
    let show = "show";
    if (!data.error) {
      if (data.data.length == 0) {
        htmlAtencion = `<div class='card'>
                          <div class='card-body text-center border border-dotted m-3'>
                            <h2 class='fw-bold text-muted'>No hay Atenciones Hasta el Momento</h2>
                          </div>
                        </div>
        `;
      } else {
        data.data.forEach((atencion) => {
          if (verifyFirst != 0) {
            expanded = "false";
            show = "";
            collapsed = "collapsed";
          }
          verifyFirst += 1;
          htmlAtencion += `
                          
                                  <div class="accordion-item">
                                      <h2 class="accordion-header" id="heading${atencion.id}">
                                          <button class="accordion-button ${collapsed} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${atencion.id}" aria-expanded="${expanded}" aria-controls="collapse${atencion.id}">
                                              Atención <br> ${atencion.fecha} <br> Cliente: ${atencion.nombreCliente} <br> Mascota: ${atencion.mascota}
                                          </button>
                                      </h2>
                                      <div id="collapse${atencion.id}" class="accordion-collapse collapse ${show}" aria-labelledby="heading${atencion.id}" data-bs-parent="#accordionAtencion">
                                          <div class="accordion-body">
                                              <form class="formAtt" id="form${atencion.id}">
                                                <div class='row'>
                                                  <div class='col-md-3 mb-2'>
                                                     <label for="Especie" class="col-md-3 col-xl-2 col-form-label fw-bold">Especie</label>
                                                  </div>
                                                  <div class='col-md-3 mb-2'>
                                                    <input type="text" class="form-control" readonly value="${atencion.especie}" id="especie" placeholder="especie">
                                                    <input type="hidden" class="form-control" value="${atencion.id}" id="id_atencion" name="id_atencion">
                                                  </div>
                                                  <div class='col-md-3 mb-2'>
                                                     <label for="edad" class="col-md-3 col-xl-2 col-form-label fw-bold">Edad</label>
                                                  </div>
                                                  <div class='col-md-3 mb-2'>
                                                    <input type="text" class="form-control" readonly value="${atencion.edad}" id="edad" placeholder="edad">
                                                  </div>
                                                  <div class='col-md-3'>
                                                     <label for="peso" class="col-md-3 col-xl-2 col-form-label fw-bold">Peso</label>
                                                  </div>
                                                  <div class='col-md-3'>
                                                    <input type="number" class="form-control" name="peso" value="${atencion.peso}" id="peso" placeholder="Peso">
                                                  </div>
                                                   <div class='col-md-3'>
                                                     <label for="altura" class="col-md-3 col-xl-2 col-form-label fw-bold">Altura</label>
                                                  </div>
                                                  <div class='col-md-3'>
                                                    <input type="number" class="form-control" name="altura" value="${atencion.altura}" id="altura" placeholder="altura">
                                                  </div>
                                                  
                                                  <div class="col-12">
                                                      <label for="descripcion" class="col-md-3 col-xl-2 col-form-label fw-bold">Descripcion</label>
                                                  </div>
                                                  <div class="col-12">
                                                      <textarea class="form-control validate" placeholder="Escribe Descripcion" id="descripcion" name="descripcion" rows="3"></textarea>
                                                  </div>
                                                  <div class="col-12">
                                                      <label for="observaciones" class="col-md-3 col-xl-2 col-form-label fw-bold">Observaciones</label>
                                                  </div>
                                                  <div class="col-12">
                                                      <textarea class="form-control validate" placeholder="Escribe Observaciones" id="observaciones" name="observaciones" rows="3"></textarea>
                                                  </div>
                                                   <div class="col-12">
                                                      <label for="diagnosticos" class="col-md-3 col-xl-2 col-form-label fw-bold">Diagnosticos</label>
                                                  </div>
                                                  <div class="col-12">
                                                      <textarea class="form-control validate" placeholder="Escribe Diagnosticos" id="diagnosticos" name="diagnosticos" rows="3"></textarea>
                                                  </div>
                                                   <div class="col-12">
                                                      <label for="tratamiento" class="col-md-3 col-xl-2 col-form-label fw-bold">Tratamiento</label>
                                                  </div>
                                                  <div class="col-12">
                                                      <textarea class="form-control validate" placeholder="Escribe Tratamiento" id="tratamiento" name="tratamiento" rows="3"></textarea>
                                                  </div>
                                                  <div class="col-12 mt-3">
                                                      <button class="btn btn-primary btnColorGeneral" type="submit">
                                                        <i class="btnIcon align-middle me-2 fas fa-fw fa-save"></i>
                                                        <div class="spinner-border spinner-border-sm text-white me-2 btnLoad d-none" role="status">
                                                          <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                      </button>
                                                  </div>
                                                </div>
                                              </form>
                                              
                                          </div>
                                      </div>
                                  </div>
  
              `;
        });
      }

      listaAtenciones.innerHTML = htmlAtencion;
      decimalInput();
      handleForm();
    } else {
      Swal.fire({
        icon: "error",
        text: data.message,
      });
    }
  } catch (error) {
    console.log(error);
  }
}

function handleForm() {
  // Obtener todos los formularios con clase 'formAtt'
  let forms = document.querySelectorAll("form.formAtt");

  // Iterar sobre cada formulario para agregar el evento submit
  forms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      // Evitar el comportamiento predeterminado de envío del formulario
      event.preventDefault();

      const botonPresionado = event.submitter; 
      const btnIcon = form.querySelector('.btnIcon');
      const btnLoad = form.querySelector('.btnLoad');
      // Agregar la clase d-none para ocultar el div
      btnIcon.classList.add('d-none');
      btnLoad.classList.remove('d-none');

      

    });
  });
}

function decimalInput() {
  // Obtener todos los inputs dentro del div con clase 'inputdecimal'
  // Obtener todos los inputs dentro del div con clase 'inputdecimal'
  const inputs = document.querySelectorAll(
    '.inputdecimal input[type="number"]'
  );

  // Iterar sobre cada input para agregar el evento input
  inputs.forEach((input) => {
    input.addEventListener("input", function () {
      // Guardar la posición del cursor
      const start = this.selectionStart;
      const end = this.selectionEnd;

      // Obtener el valor actual del input
      let valor = this.value;

      // Reemplazar cualquier caracter que no sea un número o punto decimal
      valor = valor.replace(/[^\d.]/g, "");

      // Verificar si ya hay un punto decimal presente
      if (valor.indexOf(".") !== -1) {
        // Si hay un punto decimal, dividir en parte entera y decimal
        let partes = valor.split(".");
        partes[0] = partes[0].replace(/\D/g, ""); // Remover caracteres no numéricos de la parte entera
        partes[1] = partes[1].replace(/\D/g, "").substring(0, 2); // Tomar solo los primeros dos caracteres de la parte decimal numérica
        valor = partes[0] + (partes[1] ? "." + partes[1] : ""); // Reconstruir el valor formateado
      } else {
        valor = valor.replace(/\D/g, ""); // Si no hay punto decimal, remover caracteres no numéricos
      }

      // Actualizar el valor del input con el valor formateado
      this.value = valor;

      // Restaurar la posición del cursor después de actualizar el valor
      this.setSelectionRange(
        start + (valor.length - this.value.length),
        end + (valor.length - this.value.length)
      );
    });
  });
}
