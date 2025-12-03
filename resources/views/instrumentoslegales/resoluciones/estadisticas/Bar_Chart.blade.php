<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico con Membrete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .membrete {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: rgb(88, 126, 207);
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 20px;
            background-color: #fff;
        }
        .hidden-membrete {
            display: none;
        }
        .card-title {
            margin: 0;
            font-size: 1.25em;
        }
        .card-tools {
            float: right;
        }
        .card-body {
            padding: 20px;
        }
        .chart {
            position: relative;
            height: 250px;
        }
        #mensaje-grafico {
            text-align: center;
            padding: 50px;
            font-size: 1.2em;
            color: #c21919;
        }
    </style>
</head>
<body>

<div class="membrete hidden-membrete" id="membrete-pdf">
    <h2>CONCEJO MUNICIPAL MUNICIPIO ESCUQUE</h2>
    <p>Dirección: Palacio Municipal. Frente a la Plaza Bolívar-Escuque. Despacho del Concejo Municipal.</p>
    <p>Correo: camaramunicipalescuque@gmail.com</p>
    <p>Teléfonos: 0271-2951065/2950405</p>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa-solid fa-chart-column"></i> Chart.js</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="barChart" style="max-width: 100%;"></canvas>
            <div id="mensaje-grafico">
                <i class="fas fa-info-circle" style="margin-right: 10px;"></i>
                Seleccione la fecha y haga clic en "Generar Gráfico" para ver las estadísticas.
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.jsPDF = window.jspdf.jsPDF;

    document.addEventListener('DOMContentLoaded', function () {
        var conteoMensual = {!! $conteoMensual !!}; // Variable corregida
        var barChartCanvas = document.getElementById('barChart').getContext('2d');
        var barChart;
        function generateChart(anio) {
            var barChartData = {
                labels: [],
                datasets: [{
                    label: 'RESOLUCIONES', // Etiqueta corregida
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: conteoMensual
                }]
            };

            for (let i = 0; i < 12; i++) {
                let monthLabel = new Date(2023, i, 1).toLocaleDateString('es-ES', { month: 'long' });
                barChartData.labels.push(monthLabel + (anio ? ' ' + anio : ''));
            }

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: anio ? 'AÑO DE APROBACIÓN: ' + anio : 'AÑO DE APROBACIÓN:',
                        font: {
                            size: 18
                        },
                        position: 'bottom'
                    }
                }
            };

            if (barChart) {
                barChart.destroy();
            }

            barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });

            document.getElementById('mensaje-grafico').style.display = 'none';
        }

        document.getElementById('generateChart').addEventListener('click', function () {
            var anio = document.getElementById('yearInput').value;
            if (anio && anio.length === 10) {
                anio = anio.substring(0, 4);
                fetch(`/obtenerConteoMensualPorAnio?anio=${anio}`) // Ruta corregida
                    .then(response => response.json())
                    .then(data => {
                        conteoMensual = data.conteoMensual;
                        generateChart(anio);
                    })
                    .catch(error => {
                        console.error("Error al obtener datos:", error);
                    });
            } else {
                alert('Por favor, seleccione una fecha válida.');
            }
        });

        document.getElementById('estadisticaModal').addEventListener('shown.bs.modal', function () {
            let anio = new Date().getFullYear();
            let anioFormateado = `${anio}-01-01`;
            document.getElementById('yearInput').value = anioFormateado;
        });

        document.getElementById('downloadPDF').addEventListener('click', function() {
            var membrete = document.getElementById('membrete-pdf');
            membrete.classList.remove('hidden-membrete'); // Hacer visible el membrete
            var canvas = document.getElementById('barChart');

            html2canvas(membrete).then(function(membreteCanvas) {
                var membreteImg = membreteCanvas.toDataURL('image/png');
                return html2canvas(canvas).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    var doc = new jsPDF('p', 'mm', 'a4');

                    // Añadir el membrete
                    doc.addImage(membreteImg, 'PNG', 10, 10, 190, 40);

                    // Añadir la imagen del gráfico
                    var imgYPos = 100;
                    var width = doc.internal.pageSize.width;
                    var height = doc.internal.pageSize.height;
                    var canvasAspectRatio = canvas.width / canvas.height;
                    var pageAspectRatio = width / (height - imgYPos);
                    var scaleFactor;

                    if (canvasAspectRatio > pageAspectRatio) {
                        scaleFactor = (width) / canvas.width;
                    } else {
                        scaleFactor = (height - imgYPos) / canvas.height;
                    }

                    var scaledWidth = canvas.width * scaleFactor;
                    var scaledHeight = canvas.height * scaleFactor;
                    var xPos = (width - scaledWidth) / 2;
                    var yPos = imgYPos;

                    doc.addImage(imgData, 'PNG', xPos, yPos, scaledWidth, scaledHeight);
                    doc.save('GRAFICA.pdf');
                    membrete.classList.add('hidden-membrete'); // Volver a ocultar el membrete
                });
            }).catch(function(error) {
                console.error("html2canvas error:", error);
                alert("Error creando PDF. Por favor, revisa la consola para más detalles.");
            });
        });
    });
</script>

</body>
</html>
