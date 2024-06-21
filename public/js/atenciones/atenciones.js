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
}
