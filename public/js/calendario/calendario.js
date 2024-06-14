document.addEventListener("DOMContentLoaded", (e) => {
  getCalendar();
});

function getCalendar() {
  var calendarEl = document.getElementById("calendarAll");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    buttonText: {
      today: "Hoy",
      month: "Mes",
      week: "Semana",
      day: "Día",
    },
    events: function (fetchInfo, successCallback, failureCallback) {
      let start = fetchInfo.startStr;
      let end = fetchInfo.endStr;
      fetch("/calendario/apiGetCitasAtenciones?start=" + start + "&end=" + end)
        .then((response) => response.json())
        .then((data) => {
          let events = data.data.map(function (event) {
            return {
              id: event.id,
              title: event.descripcion,
              start: event.start,
              end: event.end, // Ajusta esto según tus datos
              color: event.color, 
              //extendedProps: {
                //tipo: event.tipo, // Si tienes un campo tipo para diferenciar entre cita y atención
              //},
            };
          });
          successCallback(events);
        })
        .catch((error) => {
          console.error("Error fetching events:", error);
          failureCallback(error);
        });
    },
  });
  calendar.render();
}
