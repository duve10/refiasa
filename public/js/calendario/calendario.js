document.addEventListener("DOMContentLoaded", (e) => {
  getCalendar();
});

function getCalendar() {
  var calendarEl = document.getElementById("calendarAll");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    buttonText: {
      today: "Hoy",
      month: "Mes",
      week: "Semana",
      day: "Día",
    },
    events: [
      // Aquí puedes cargar eventos desde tu base de datos u otra fuente
      {
        title: "Evento 1",
        start: "2024-06-10",
      },
      {
        title: "Evento 2",
        start: "2024-06-15",
        end: "2024-06-17",
      },
      // Agrega más eventos según sea necesario
    ],
  });
  calendar.render();
}


