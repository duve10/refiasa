function iniciarFecha(idInput) {
    flatpickr('#' + idInput, {
        enableTime:false,
        dateFormat: 'd-m-Y',
        minDate: 'today',
        time_24hr:true,
        disableMobile:true
    })
}

function mostrarLoading() {
    $('.loading').removeClass('d-none')
}

function ocultarLoading() {
    $('.loading').addClass('d-none')
}