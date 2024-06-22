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

function getExcel() {
  let btnExcel = document.getElementById("btnExcel");

  btnExcel.addEventListener("click", async (e) => {
    let yearGroup = $("#yearGroup").val();

    let sortedCol = $("#tableReport").dataTable().fnSettings().aaSorting[0][0];
    let sortedDir = $("#tableReport").dataTable().fnSettings().aaSorting[0][1];

    let formExcel = new FormData();
    formExcel.append("yearGroup", yearGroup);

    formExcel.append("sortedCol", sortedCol);
    formExcel.append("sortedDir", sortedDir);

    try {
      let response = await fetch("api/getExcelClinical.cfm", {
        method: "POST",
        body: formExcel,
      });

      let blob = await response.blob();

      if (!response.ok) {
        throw new Error("Error al obtener el archivo Excel");
      }

      // Crea un enlace (link) para descargar el archivo Excel
      let url = window.URL.createObjectURL(blob);
      let a = document.createElement("a");

      a.href = url;
      a.download = "clinical_Report_student.xlsx";
      document.body.appendChild(a);

      // Simula un clic en el enlace para iniciar la descarga del archivo
      a.click();

      // Elimina el enlace del documento después de la descarga
      window.URL.revokeObjectURL(url);
      document.body.removeChild(a);

      // Muestra un mensaje de éxito al usuario
      Swal.fire({
        title: "Success",
        text: "Se ha descargado el archivo Excel correctamente",
        icon: "success",
        showCancelButton: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ok",
      });
    } catch (error) {
      console.error(error);
      Swal.fire({
        icon: "error",
        text: "Se ha producido un error al obtener el archivo Excel",
      });
    }
  });
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
