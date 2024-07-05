document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  /*getExcel();
    sendMail();
    sendAll();*/
});

function getDataTable() {
  let tableReport = $("#tableUsuarios")
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
        url: "usuarios/apiGetUsuarios",
        type: "POST",
        data: function (data) {
          /*let yearGroup = $("#yearGroup").val();
            let registered = $("#registered").val();
            data.yearGroup = yearGroup;
            data.registered = registered;*/
        },
      },
      columns: [
        { data: "imagen", className: "text-center", orderable: false },
        { data: "username", className: "text-start", orderable: false },
        { data: "name", className: "text-start", orderable: false },
        { data: "lastname", className: "text-start", orderable: false },
        { data: "phone", className: "text-center", orderable: false },
        { data: "mail", className: "text-start", orderable: false },
        { data: "perfil", className: "text-start", orderable: false },
        { data: "status", className: "text-center", orderable: false },
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

  eliminarUser(tableReport);
  guardarUsuario(tableReport);
}

function eliminarUser(dataTableUsers) {
  $("#tableUsuarios tbody").on("click", ".deleteUser", function () {
    // Aquí manejas la lógica para eliminar el elemento deseado
    let dataId = $(this).data("id");
    let userName = $(this).data("user");

    Swal.fire({
      title: `¿Esta seguro de inactivar ${userName}?`,
      showDenyButton: true,
      showCancelButton: true,
      showConfirmButton: false,
      confirmButtonText: "Save",
      denyButtonText: `Inactivar`,
    }).then(async (result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isDenied) {
        let datos = new FormData();
        datos.append("id", dataId);
        try {
          let response = await fetch("usuarios/apiEliminar", {
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

          dataTableUsers.draw();
        } catch (error) {
          console.log(error);
        }
      }
    });
  });
}

function guardarUsuario(dataTableUsers) {
  let formUsuario = document.getElementById("formUsuario");

  formUsuario.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formUsuario);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../usuarios/apiRegistrar", {
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
          dataTableUsers.draw();
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
