document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
});

function getDataTable() {
  let tableReport = $("#tableAtenciones")
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
        url: "atenciones/apiGetAtenciones",
        type: "POST",
        data: function (data) {
          /*let yearGroup = $("#yearGroup").val();
            let registered = $("#registered").val();
            data.yearGroup = yearGroup;
            data.registered = registered;*/
        },
      },
      columns: [
        { data: "fecha", className: "fw-bold", orderable: false },
        { data: "mascota", className: "text-center", orderable: false },
        { data: "especie", className: "text-center", orderable: false },
        { data: "descripcion", className: "text-center", orderable: false },
        { data: "nombreCliente", className: "text-start", orderable: false },
        { data: "estadoatencion", className: "text-center", orderable: false },
        { data: "veterinario", className: "text-start", orderable: false },
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

  eliminarAtencion(tableReport)
}

function eliminarAtencion(dataTableAtencion) {
  $("#tableAtenciones tbody").on("click", ".deleteAtencion", function () {
    console.log(111);
    // Aquí manejas la lógica para eliminar el elemento deseado
    let dataId = $(this).data("id");
    let nombreCliente = $(this).data("nombre");

    Swal.fire({
      title: `¿Esta seguro eliminar atencion de ${nombreCliente}?`,
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
          let response = await fetch("atenciones/apiEliminar", {
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

          dataTableAtencion.draw();
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}
