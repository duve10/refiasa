document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
});

function guardarProducto(dataTableProducto) {
  let formProducto = document.getElementById("formProducto");

  formProducto.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formProducto);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../productos/apiRegistrar", {
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
          dataTableProducto.draw();
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

function cerrarYResetearModal() {
  // Cerrar el modal

  $("#crearProducto").modal("hide");

  // Resetear el formulario dentro del modal
  document.getElementById("formProducto").reset();
}

function getDataTable() {
  let tableReport = $("#tableProductos")
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
        url: "productos/apiGetProductos",
        type: "POST",
        data: function (data) {
          /*let yearGroup = $("#yearGroup").val();
            let registered = $("#registered").val();
            data.yearGroup = yearGroup;
            data.registered = registered;*/
        },
      },
      columns: [
        { data: "foto", className: "text-center", orderable: false },
        { data: "nombre", className: "text-start", orderable: false },
        { data: "descripcion", className: "text-start", orderable: false },
        { data: "precio", className: "text-center", orderable: false },
        { data: "stock", className: "text-center", orderable: false },
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
  eliminarProducto(tableReport);

}


function eliminarProducto(dataTableProducto) {
  $("#tableProductos tbody").on("click", ".deleteProducto", function () {
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
          let response = await fetch("productos/apiEliminar", {
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

          dataTableProducto.draw();
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}


