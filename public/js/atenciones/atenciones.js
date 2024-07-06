document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  iniDate()
});

function iniDate() {
  // Instancia de Flatpickr para el campo "Desde"
  const fpDesde = flatpickr("#fecha_desde", {
    enableTime: false,
    dateFormat: "d-m-Y",
    time_24hr: true,
    disableMobile: true,
   
  });

  // Instancia de Flatpickr para el campo "Hasta"
  const fpHasta = flatpickr("#fecha_hasta", {
    enableTime: false,
    dateFormat: "d-m-Y",
    time_24hr: true,
    disableMobile: true,
  });
}

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
          let fecha_desde = $("#fecha_desde").val();
          let fecha_hasta = $("#fecha_hasta").val();
          data.fecha_desde = fecha_desde;
          data.fecha_hasta = fecha_hasta;
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

  eliminarAtencion(tableReport);
  viewAtt(tableReport);
  buscar(tableReport)
}
function buscar(datatableReport) {
  let btnBuscar = document.getElementById('btnBuscar')
  
  btnBuscar.addEventListener('click', e => {
    datatableReport.draw();
  })
}

function eliminarAtencion(dataTableAtencion) {
  $("#tableAtenciones tbody").on("click", ".deleteAtencion", function () {
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

function viewAtt(dataTableAtt) {
  $("#tableAtenciones tbody").on("click", ".viewAtt", async function () {
    let dataId = $(this).data("id");

    try {
      let response = await fetch("atenciones/getServicioProducto?id=" + dataId);

      let data = await response.json();

      let total = 0;
      let htmlAll = ``;
      data.forEach((el) => {
        total = total + parseFloat(el.precio);
        htmlAll =
          htmlAll +
          `
        <div class='col-12'>
          <div class='row mb-2 borderList'>
            <div class='col-md-3'>
              <img src="${el.foto}" class="avatar img-fluid rounded me-1" alt="name">
            </div>
            <div class='col-md-6 d-flex align-items-center justify-content-center'>
              <p class='m-0'><strong>Nombre:</strong>${el.nombre}</p>
            </div>
            <div class='col-md-3 d-flex align-items-center justify-content-center'>
              <p class='m-0'><strong>Precio:</strong>${el.precio}</p>
            </div>
          </div>
        </div>
        `;
      });

      htmlAll =
        htmlAll +
        `
        <div class=col-12>
          <p><strong>Total:</strong>${total}</p>
        </div>
      `;

      Swal.fire({
        title: "Lista de Productos / Servicios",
        showDenyButton: false,
        html: htmlAll,
        width: "80%",
        showCancelButton: false,
        confirmButtonText: "Salir",
        denyButtonText: `Don't save`,
      });
    } catch (error) {}
  });
}
