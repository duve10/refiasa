document.addEventListener("DOMContentLoaded", (e) => {
    getDataTable();
    /*getExcel();
    sendMail();
    sendAll();*/
  });
  
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
  