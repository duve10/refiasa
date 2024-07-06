document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  initFecha();
});

function getDataTable() {
  let tableReport = $("#tableClientes")
    .DataTable({
      searching: false,
      ordering: false,
      dom: "Bfrtip",
      pageLength: 20,
      buttons: [],
      processing: true,
      serverSide: true,
      responsive: false,
      ajax: {
        url: "clientes/apiGetClientes",
        type: "POST",
        data: function (data) {
          /*let yearGroup = $("#yearGroup").val();
            let registered = $("#registered").val();
            data.yearGroup = yearGroup;
            data.registered = registered;*/
        },
      },
      columns: [
        { data: "nombre", className: "fw-bold", orderable: false },
        { data: "apellido_paterno", className: "text-start", orderable: false },
        { data: "tipoDoc", className: "text-center", orderable: false },
        { data: "documento", className: "text-center", orderable: false },
        { data: "telefono", className: "text-center", orderable: false },
        { data: "urlMascota", className: "text-center", orderable: false },
        { data: "username", className: "text-center", orderable: false },
        { data: "acciones", className: "text-center", orderable: false },
      ],
    })
    .on("preXhr.dt", function (e, settings, data) {
      $(".loading").removeClass("d-none");
    })
    .on("xhr.dt", function (e, settings, json, xhr) {
      $(".loading").addClass("d-none");
    });

  $("#registered").change(function () {
    tableReport.draw();
  });

  guardarCliente(tableReport);
  viewUrl(tableReport);
}

function guardarCliente(dataTableCliente) {
  let formCliente = document.getElementById("formCliente");

  formCliente.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formCliente);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../clientes/apiRegistrar", {
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
          dataTableCliente.draw();
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
  $("#crearCliente").on("hidden.bs.modal", function (e) {
    cerrarYResetearModal();
  });
}

function cerrarYResetearModal() {
  // Cerrar el modal
  initFecha();
  $("#crearCliente").modal("hide");

  // Resetear el formulario dentro del modal
  document.getElementById("formCliente").reset();
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





function viewUrl(dataTableMascota) {
  
  $("#tableClientes tbody").on("click", ".viewUrl", function () {
    // Aquí manejas la lógica para eliminar el elemento deseado
    let url = $(this).data("url");
    console.log(11);
    Swal.fire({
      title: `El Url es el siguiente`,
      showDenyButton: true,
      showCancelButton: true,
      html: `<p>${url}</p>`,
      showConfirmButton: false,
      confirmButtonText: "Save",
      denyButtonText: `Eliminar`,
    });
  });
}