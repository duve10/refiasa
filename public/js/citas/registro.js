document.addEventListener("DOMContentLoaded", (e) => {
  guardarCita();
  selectCliente();
  focusSelect2();
});

function guardarCita() {
  console.log(11);
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

function focusSelect2() {
  $(document).on("select2:open", () => {
    document.querySelector(".select2-search__field").focus();
  });
}
