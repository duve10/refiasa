document.addEventListener("DOMContentLoaded", (e) => {
  guardarCita();
  selectCliente();
  focusSelect2();
  iniciarFecha("fecha");
});

function guardarCita() {
  let formCita = document.getElementById("formCita");

  formCita.addEventListener("submit", async (e) => {
    e.preventDefault();
    let datos = new FormData(formCita);
    //datos.append("idCliente", idCliente);
    try {
      mostrarLoading();
      let response = await fetch("../citas/apiRegistrar", {
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
          window.location.href = "/citas";
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

  $("#id_cliente").on("select2:select", function (e) {
    let clienteId = $("#id_cliente").val();
    getMascotas(clienteId);
  });
}

function focusSelect2() {
  $(document).on("select2:open", () => {
    document.querySelector(".select2-search__field").focus();
  });
}

async function getMascotas(idCliente) {
  let datos = new FormData();
  datos.append("idCliente", idCliente);

  try {
    let response = await fetch("../mascotas/apiGetMascotasByCliente", {
      method: "POST",
      body: datos,
    });

    let data = await response.json();

    if (!data.error) {
      let mascotas = data.data;
      let divMascotas = document.getElementById("divMascotas");

      let htmlMascotas = "";
      mascotas.forEach((mascota) => {
        htmlMascotas =
          htmlMascotas +
          `
            <div class="col">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="radio" name="id_mascota" value="${mascota.id}" role="switch" id="mascota${mascota.id}">
                    <label class="form-check-label" for="mascota${mascota.id}">${mascota.nombre}</label>
                </div>
            </div>
            `;
      });
      let htmlDiv = `<div class="row">${htmlMascotas}</div>`;
      console.log(htmlDiv);
      divMascotas.innerHTML = "";
      divMascotas.innerHTML = htmlDiv;
    } else {
      console.log(data.message);
    }
  } catch (error) {
    console.log(error);
  }
}
