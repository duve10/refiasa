document.addEventListener("DOMContentLoaded", (e) => {
  guardarAtencion();
  selectCliente();
  selectVeterinario();
  focusSelect2();
  iniciarFechaChange("fecha");
  selectServicios();
});

function iniciarFechaChange(idInput) {
  flatpickr("#" + idInput, {
    enableTime: true,
    dateFormat: "d-m-Y H:i",
    minDate: "today",
    time_24hr: true,
    disableMobile: true,
    disable: [
      function (date) {
        // Devolver true para deshabilitar domingos (0 = domingo, 1 = lunes, ..., 6 = sábado)
        return date.getDay() === 0; // 0 es domingo
      },
    ],
  });
}

function guardarAtencion() {
  let formAtencion = document.getElementById("formAtencion");

  formAtencion.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formAtencion);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../atenciones/apiRegistrar", {
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
        }).then(() => {
          window.location.href = "/atenciones";
        });
      } else {
        ocultarLoading();
        Swal.fire({
          icon: "error",
          text: data.message,
        });
      }
    } catch (error) {
      console.log(error);
    }
  });
}

function selectCliente() {
  $("#id_cliente").select2({
    ajax: {
      url: "../clientes/apiGetClientesSelect",
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
    dropdownParent: $("#id_cliente").parent(),
    placeholder: "Escribe Nombre o documento de cliente",
  });

  $("#id_cliente").on("select2:select", function (e) {
    let clienteId = $("#id_cliente").val();
    getMascotas(clienteId);
  });
  $("#id_cliente").on("select2:clearing", function (e) {
    let divMascotas = document.getElementById("divMascotas");
    let htmlDiv = `<div class="w-100 h-100  d-flex align-items-center justify-content-center border border-dotted">
                                                          <h5 class="fw-bold m-0 text-muted p-2">Seleccionar Cliente</h5>
                                                      </div>`;

    divMascotas.innerHTML = "";
    divMascotas.innerHTML = htmlDiv;
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

  $("#id_cliente").on("select2:select", function (e) {
    let clienteId = $("#id_cliente").val();
    getMascotas(clienteId);
  });
  $("#id_cliente").on("select2:clearing", function (e) {
    let divMascotas = document.getElementById("divMascotas");
    let htmlDiv = `<div class="w-100 h-100  d-flex align-items-center justify-content-center border border-dotted">
                                                            <h5 class="fw-bold m-0 text-muted p-2">Seleccionar Cliente</h5>
                                                        </div>`;

    divMascotas.innerHTML = "";
    divMascotas.innerHTML = htmlDiv;
  });
}

function selectServicios() {
  $("#id_servicio").select2({
    placeholder: "Seleccionar Servicios",
    allowClear: true,
  });
}

function focusSelect2() {
  $(document).on("select2:open", () => {
    document.querySelector(".select2-search__field").focus();
  });
}

async function getMascotas(idCliente) {
  let datos = new FormData();
  datos.append("idCliente", idCliente);

  try {
    let response = await fetch("../mascotas/apiGetMascotasByCliente", {
      method: "POST",
      body: datos,
    });

    let data = await response.json();

    if (!data.error) {
      let mascotas = data.data;
      let divMascotas = document.getElementById("divMascotas");

      let htmlMascotas = "";
      if (mascotas.length == 0) {
        htmlMascotas = `<a class="btn btn-primary btnColorGeneral" href="/mascotas/registro">
                                  + Agregar Mascota
                              </a>`;
      } else {
        mascotas.forEach((mascota) => {
          htmlMascotas =
            htmlMascotas +
            `
                <div class="col">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" name="id_mascota" value="${mascota.id}" role="switch" id="mascota${mascota.id}">
                        <label class="form-check-label" for="mascota${mascota.id}">${mascota.nombre}</label>
                    </div>
                </div>
                `;
        });
      }

      let htmlDiv = `<div class="row">${htmlMascotas}</div>`;

      divMascotas.innerHTML = "";
      divMascotas.innerHTML = htmlDiv;
    } else {
      console.log(data.message);
    }
  } catch (error) {
    console.log(error);
  }
}

function changeDate() {
  let fechaForm = document.getElementById("fecha");

  fechaForm.addEventListener("change", (e) => {
    console.log(e);
  });
}
