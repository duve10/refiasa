document.addEventListener("DOMContentLoaded", (e) => {
  getCalendar();
  main();

});

function getCalendar() {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: 'es', 
    hiddenDays: [0],
    headerToolbar: false,
    buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día'
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


// Función para configurar las opciones iniciales del gráfico
function getChartOptions() {
  return {
    series: [{
      name: 'Inflation',
      data: [] // Datos vacíos inicialmente
    }],
    chart: {
      height: 350,
      type: 'bar',
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        dataLabels: {
          position: 'top',
        },
      }
    },
    dataLabels: {
      enabled: true,
      offsetY: -20,
      style: {
        fontSize: '12px',
        colors: ["#304758"]
      }
    },
    xaxis: {
      categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
      position: 'top',
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        fill: {
          type: 'gradient',
          gradient: {
            colorFrom: '#D8E3F0',
            colorTo: '#BED1E6',
            stops: [0, 100],
            opacityFrom: 0.4,
            opacityTo: 0.5,
          }
        }
      },
      tooltip: {
        enabled: true,
      }
    },
    yaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
        formatter: function (val) {
          return val + "%";
        }
      }
    },
    title: {
      text: 'Atenciones por mes',
      floating: true,
      offsetY: 330,
      align: 'center',
      style: {
        color: '#444'
      }
    }
  };
}

// Función para inicializar el gráfico
function initializeChart(options) {
  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
  return chart;
}

// Función para obtener datos de la API y actualizar el gráfico
function fetchDataAndUpdateChart(chart) {
  fetch('atenciones/apiMes')
    .then(response => response.json())
    .then(data => {
      // Asumiendo que la respuesta de la API tiene un formato como este:
      // { "series": [12, 20, 25, 50, 32, 36, 32, 23, 14, 8, 52, 2] }

      // Actualiza los datos del gráfico
      chart.updateSeries([{
        name: 'Inflation',
        data: data.series // Actualiza con los datos recibidos
      }]);
    })
    .catch(error => console.error('Error al obtener los datos:', error));
}

// Función principal para ejecutar todo el flujo
function main() {
  const options = getChartOptions();
  const chart = initializeChart(options);
  fetchDataAndUpdateChart(chart);
}
