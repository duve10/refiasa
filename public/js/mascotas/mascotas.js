document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  selectCliente();
  initFecha();
  getRazas();
  manejarCierreModal();
  /*getExcel();
    sendMail();
    sendAll();*/
});

function guardarMascota(dataTableMascota) {
  let formMascota = document.getElementById("formMascota");

  formMascota.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formMascota);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../mascotas/apiRegistrar", {
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
          ocultarLoading();

          cerrarYResetearModal();
          dataTableMascota.draw();
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

function manejarCierreModal() {
  $("#crearMascota").on("hidden.bs.modal", function (e) {
    cerrarYResetearModal();
  });
}

function cerrarYResetearModal() {
  // Cerrar el modal
  initFecha();
  $("#crearMascota").modal("hide");
  $("#id_cliente").val(null).trigger("change.select2");

  let razaSelect = document.getElementById("raza");
  razaSelect.innerHTML = '<option value="">Seleccione una raza</option>';
  // Resetear el formulario dentro del modal
  document.getElementById("formMascota").reset();
}

function getDataTable() {
  let tableReport = $("#tableMascotas")
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
        url: "mascotas/apiGetMascotas",
        type: "POST",
        data: function (data) {
            let filtroEspecie = $("#filtroEspecie").val();
            data.filtroEspecie = filtroEspecie;
        },
      },
      columns: [
        { data: "foto", className: "fw-bold", orderable: false },
        { data: "nombre", className: "fw-bold", orderable: false },
        { data: "especie", className: "text-start", orderable: false },
        { data: "raza", className: "text-start", orderable: false },
        { data: "edad", className: "text-center", orderable: false },
        { data: "altura", className: "text-center", orderable: false },
        { data: "peso", className: "text-center", orderable: false },
        { data: "nombreCliente", className: "text-start", orderable: false },
        { data: "username", className: "text-center", orderable: false },
        { data: "acciones", className: "text-center", orderable: false },
      ],
    })
    .on("preXhr.dt", function (e, settings, data) {
      //$(".loading").removeClass("d-none");
    })
    .on("xhr.dt", function (e, settings, json, xhr) {
      //$(".loading").addClass("d-none");
    });

  $("#registered").change(function () {
    tableReport.draw();
  });

  buscarEspecie(tableReport);
  guardarMascota(tableReport);
  eliminarMascota(tableReport);
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
}

function initFecha() {
  flatpickr("#fecha_nac", {
    enableTime: false,
    dateFormat: "d-m-Y",
    maxDate: "today",
    static: true,
    time_24hr: true,
    disableMobile: true,
  });
}

function getRazas() {
  let especie = document.getElementById("especie");
  let razaSelect = document.getElementById("raza");

  especie.addEventListener("change", async (e) => {
    let id_especie = especie.value;
    try {
      let response = await fetch("/razas/apiGetRaza?id_especie=" + id_especie, {
        method: "GET",
      });

      let data = await response.json();

      if (!data.error) {
        razaSelect.innerHTML = '<option value="">Seleccione una raza</option>';
        data.data.forEach(function (raza) {
          let option = document.createElement("option");
          option.value = raza.id;
          option.textContent = raza.nombre;
          razaSelect.appendChild(option);
        });
      }
    } catch (error) {}
  });
}



function eliminarMascota(dataTableMascota) {
  $("#tableMascotas tbody").on("click", ".deleteMascota", function () {
    // Aquí manejas la lógica para eliminar el elemento deseado
    let dataId = $(this).data("id");
    let nombreMascoda = $(this).data("nombre");

    Swal.fire({
      title: `¿Esta seguro de eliminar ${nombreMascoda}?`,
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
          let response = await fetch("mascotas/apiEliminar", {
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

          dataTableMascota.draw();
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}

function buscarEspecie(dataTableMascota) {
  let filtroEspecie = document.getElementById("filtroEspecie");

  filtroEspecie.addEventListener("change", (e) => {
    dataTableMascota.draw();
  });
}
