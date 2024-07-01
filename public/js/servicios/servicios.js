document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  manejarCierreModal();
});

function getDataTable() {
  let tableReport = $("#tableServicios")
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
        url: "servicios/apiGetServicios",
        type: "POST",
        data: function (data) {
          let filtroCita = $("#filtroCita").val();
            /*let registered = $("#registered").val();*/
          data.filtroCita = filtroCita;
           /* data.registered = registered;*/
        },
      },
      columns: [
        { data: "foto", className: "text-start", orderable: false },
        { data: "nombre", className: "text-start", orderable: false },
        { data: "descripcion", className: "text-start", orderable: false },
        { data: "precio", className: "text-center", orderable: false },
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

  guardarProducto(tableReport);
  eliminarServicio(tableReport);
  buscarCita(tableReport);
}

function guardarProducto(dataTableServicio) {
  let formServicio = document.getElementById("formServicio");

  formServicio.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formServicio);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../servicios/apiRegistrar", {
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
          dataTableServicio.draw();
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

function eliminarServicio(dataTableServicio) {
  $("#tableServicios tbody").on("click", ".deleteServicio", function () {
    // Aquí manejas la lógica para eliminar el elemento deseado
    let dataId = $(this).data("id");
    let nombre = $(this).data("nombre");

    Swal.fire({
      title: `¿Esta seguro de eliminar ${nombre}?`,
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
          let response = await fetch("servicios/apiEliminar", {
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

          dataTableServicio.draw();
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}

function manejarCierreModal() {
  $("#crearServicio").on("hidden.bs.modal", function (e) {
    cerrarYResetearModal();
  });
}

function cerrarYResetearModal() {
  // Cerrar el modal
  $("#crearServicio").modal("hide");
  // Resetear el formulario dentro del modal
  document.getElementById("formServicio").reset();
}

function buscarCita(dataTableServicio) {
  let filtroCita = document.getElementById("filtroCita");

  filtroCita.addEventListener("change", (e) => {
    dataTableServicio.draw();
  });
}
