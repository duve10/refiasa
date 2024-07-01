document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  iniDate();
});

function iniDate() {
  // Instancia de Flatpickr para el campo "Desde"
  const fpDesde = flatpickr(".fecha_desde", {
    enableTime: false,
    dateFormat: "d-m-Y",
    time_24hr: true,
    disableMobile: true,
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        fpHasta.set("minDate", selectedDates[0]);
      }
    },
  });

  // Instancia de Flatpickr para el campo "Hasta"
  const fpHasta = flatpickr(".fecha_hasta", {
    enableTime: false,
    dateFormat: "d-m-Y",
    time_24hr: true,
    disableMobile: true,
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        fpDesde.set("maxDate", selectedDates[0]);
      }
    },
  });
}

function getDataTable() {
  let tableReport = $("#tableCitas")
    .DataTable({
      searching: false,
      ordering: false,
      dom: "Bfrtip",
      pageLength: 10,
      buttons: [],
      processing: true,
      serverSide: true,
      responsive: false,
      ajax: {
        url: "citas/apiGetCitas",
        type: "POST",
        data: function (data) {
          /*let yearGroup = $("#yearGroup").val();
            let registered = $("#registered").val();
            data.yearGroup = yearGroup;
            data.registered = registered;*/
        },
      },
      columns: [
        { data: "tipocita", className: "fw-bold", orderable: false },
        { data: "fecha", className: "fw-bold", orderable: false },
        { data: "hora", className: "text-start fw-bold", orderable: false },
        { data: "mascota", className: "text-start", orderable: false },
        { data: "especie", className: "text-start", orderable: false },
        { data: "atencion", className: "text-center", orderable: false },
        { data: "nombreCliente", className: "text-start", orderable: false },
        { data: "estadocita", className: "text-center", orderable: false },
        { data: "acciones", className: "text-center", orderable: false },
      ],
    })
    .on("preXhr.dt", function (e, settings, data) {
      $(".loading").removeClass("d-none");
    })
    .on("xhr.dt", function (e, settings, json, xhr) {
      $(".loading").addClass("d-none");
    })
    .on("init.dt", function (e, settings, json) {
      modalServicioTable(tableReport);
    });

  eliminarCita(tableReport);
}

function eliminarCita(dataTableCita) {
  $("#tableCitas tbody").on("click", ".deleteCita", function () {
    // Aquí manejas la lógica para eliminar el elemento deseado
    let dataId = $(this).data("id");
    let nombreCliente = $(this).data("nombre");

    Swal.fire({
      title: `¿Esta seguro cita de ${nombreCliente}?`,
      showDenyButton: true,
      showCancelButton: true,
      showConfirmButton: false,
      confirmButtonText: "Save",
      denyButtonText: `Eliminar`,
    }).then(async (result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isDenied) {
        let datos = new FormData();
        datos.append("id", dataId);
        try {
          let response = await fetch("citas/apiEliminar", {
            method: "POST",
            body: datos,
          });

          let data = await response.json();

          if (!data.error) {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: data.message,
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,
            });
          } else {
            Swal.fire({
              icon: "error",
              text: data.message,
            });
          }

          dataTableCita.draw();
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}

function modalServicioTable(tableData) {
  $(".modalServicio").on("click", async function () {
    let dataId = $(this).data("id");
    let nombreCliente = $(this).data("nombre");
    let id_mascota = $(this).data("idmascota");

    let response = await fetch("../citas/getServiciosCita?id=" + dataId, {
      method: "POST",
    });

    let data = await response.json();


    Swal.fire({
      title: "Registrar Atencion de la cita de " + nombreCliente,
      showDenyButton: false,
      html: `
         <div class="mb-3 text-start">
            <form class = "formAtencion">
              <label for="veterinario" class="col-md-3 col-xl-2 col-form-label fw-bold">Servicios</label>
               <div class="w-100">
                  <select class="form-control id_servicio" multiple name="id_servicio[]" id="id_servicio">
                     ${data.data
                    .map(
                        (servicio) =>
                          `<option value="${
                            servicio.id_servicio
                          }" ${
                            servicio.selected !=
                            null
                              ? "selected"
                              : ""
                          }>${
                            servicio.nombre
                          }</option>`
                      )
                      .join("")}
                  </select>
              </div>
              <label for="veterinario" class="col-md-3 col-xl-2 col-form-label fw-bold">Veterinario</label>
              <div class="w-100">
                  <input type="hidden" class="form-control" value="${id_mascota}" id="id_mascota" name="id_mascota">
                  <input type="hidden" class="form-control" value="${dataId}" id="id_cita" name="id_cita">
                  <input type="hidden" class="form-control" value="2" id="id_estadocita" name="id_estadocita">
                  <select class="form-control veterinario" name="veterinario" id="veterinario"></select>
              </div>
              <label for="descripcion" class="col-md-3 col-xl-2 col-form-label fw-bold">Descripcion</label>
              <textarea class="form-control validate" placeholder="Escribe una descripcion" id="descripcion" name="descripcion" rows="3"></textarea>
            </form>
        </div>
      `,
      showCancelButton: true,
      confirmButtonText: "Guardar",
      didOpen: () => {
        selectVeterinario();
      },
    }).then(async (result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        mostrarLoading();
        let formAtencion = document.querySelector(".formAtencion");

        const formData = new FormData(formAtencion);

        try {
          let response = await fetch("../atenciones/apiRegistrar", {
            method: "POST",
            body: formData,
          });

          let data = await response.json();

          if (!data.error) {
            const formDataCita = new FormData();
            formDataCita.append('id', dataId);
            formDataCita.append('id_estadocita', 2);

            let responseCita = await fetch('../citas/apiUpdateEstadoCita',{
              method: "POST",
              body: formDataCita,
            });

            let dataCita = await responseCita.json()

            if (!dataCita.error) {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: data.message,
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
              }).then(() => {
                ocultarLoading();
  
                tableData.draw();
              });
              
            }

          }
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}

function selectVeterinario() {
  $("#veterinario").select2({
    ajax: {
      url: "../usuarios/apiGetVetSelect",
      dataType: "json",
      type: "GET",
      delay: 250,
      data: function (params) {
        return {
          q: params.term,
        };
      },
      processResults: function (data) {
        return {
          results: data,
        };
      },
      cache: true,
    },
    allowClear: true,
    minimumInputLength: 3,
    dropdownParent: $("#veterinario").parent(),
    placeholder: "Escribe Nombre o documento de Veterinario",
  });
  $("#id_servicio").select2({
    placeholder: "Seleccionar Servicios",
    allowClear: true,
    dropdownParent: $(".formAtencion").parent(),
  });
}
