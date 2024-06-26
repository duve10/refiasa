document.addEventListener("DOMContentLoaded", (e) => {
  getDataTable();
  /*getExcel();
    sendMail();
    sendAll();*/
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

}

function sendMail() {
  let tableSend = document.getElementById("tableReport");

  tableSend.addEventListener("click", (e) => {
    let btnHtml = e.target;
    if (btnHtml.tagName == "BUTTON") {
      let dataId = btnHtml.getAttribute("data-id");
      let dataName = btnHtml.getAttribute("data-name");
      let formSend = new FormData();
      formSend.append("dataId", dataId);

      Swal.fire({
        title: `Are you sure to send email to ${dataName}?`,
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: "Send",
        denyButtonText: `Don't save`,
      }).then(async (result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $(".loading").removeClass("d-none");
          try {
            let response = await fetch("api/sendMail.cfm", {
              method: "POST",
              body: formSend,
            });

            let data = await response.json();

            if (data.error) {
              Swal.fire({
                icon: "error",
                text: "Se ha producido un error al enviar",
              });
            } else {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "The Email has been sent",
                showConfirmButton: false,
                timer: 1500,
              });

              let divId = document.getElementById(`${data.idStudent}`);
              let btnSendUser = document.getElementById(`btn${data.idStudent}`);

              btnSendUser.classList.remove("btn-warning");
              btnSendUser.classList.add("btn-danger");
              btnSendUser.innerText = "ReSend";

              divId.innerHTML = data.dateSend;
              $(".loading").addClass("d-none");
            }
          } catch (error) {
            Swal.fire({
              icon: "error",
              text: "Se ha producido un error al enviar",
            });
          }
        }
      });
    }
  });
}

function sendAll() {
  let btnAll = document.getElementById("btnAll");

  btnAll.addEventListener("click", (e) => {
    Swal.fire({
      title: `Are you sure to send an email to all parents who have not completed the form?`,
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: "Send",
      denyButtonText: `Don't send`,
    }).then(async (result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $(".loading").removeClass("d-none");
        try {
          let response = await fetch("api/sendMailsStudent.cfm", {
            method: "POST",
          });

          let data = await response.json();

          if (data.error) {
            Swal.fire({
              icon: "error",
              text: "Se ha producido un error al enviar",
            });
          } else {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "The Email has been sent",
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,
            }).then(() => {
              // Esta función se ejecutará después de que termine el temporizador
              // Puedes colocar aquí la función que deseas ejecutar
              location.reload();
            });
          }
        } catch (error) {
          Swal.fire({
            icon: "error",
            text: "Se ha producido un error al enviar",
          });
        }
      }
    });

    $(".loading").addClass("d-none");
  });
}
