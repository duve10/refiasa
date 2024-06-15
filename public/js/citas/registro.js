document.addEventListener("DOMContentLoaded", (e) => {
  guardarCita();
  selectCliente();
  focusSelect2();
  iniciarFechaChange("fecha");
  selectServicios();
});

function iniciarFechaChange(idInput) {
  flatpickr("#" + idInput, {
    enableTime: false,
    dateFormat: "d-m-Y",
    minDate: "today",
    time_24hr: true,
    disableMobile: true,
    onChange: async function (selectedDates, dateStr, instance) {
      let fechaSelected = dateStr;
      try {
        let response = await fetch(
          "../citas/getApiListaHorasPorFecha?fechaSelected=" + fechaSelected,
          {
            method: "GET",
          }
        );

        let data = await response.json();

        const selectHoras = document.getElementById("id_hora");
        selectHoras.innerHTML = ""; // Limpiar el select

        // Agregar la opción inicial "Seleccionar hora"
        const optionSeleccionar = document.createElement("option");
        optionSeleccionar.value = "";
        optionSeleccionar.textContent = "Selecciona una hora";
        selectHoras.appendChild(optionSeleccionar);

        // Agregar las nuevas opciones al select
        data.data.forEach((hora) => {
          const option = document.createElement("OPTION");
          option.value = hora.id;
          option.textContent = hora.hora;

          if (hora.idCita != null) {
            option.classList.add('optionColor');
          }
           

          selectHoras.appendChild(option);
        });
      } catch (error) {}
    },
  });
}

function guardarCita() {
  let formCita = document.getElementById("formCita");

  formCita.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formCita);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../citas/apiRegistrar", {
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
          window.location.href = "/citas";
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
