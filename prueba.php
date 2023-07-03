<!DOCTYPE html>
<html lang="es">
<?php
require_once("dbConnection.php");
// Obtener el nivel de humedad máximo
$maxHumedad = mysqli_query($mysqli, "SELECT MAX(dato) AS max_humedad FROM sistema_humedad");
$row = $maxHumedad->fetch_assoc();
$maxValor = $row['max_humedad'];

// Obtener el último nivel de humedad
$ultimaHumedad = mysqli_query($mysqli, "SELECT dato FROM sistema_humedad ORDER BY id DESC LIMIT 1");
$row = $ultimaHumedad->fetch_assoc();
$ultimoValor = $row['dato'];

// Cerrar la conexión
$mysqli->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de datos de humedad</title>
    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <canvas id="grafica1"></canvas>
    <script type="text/javascript">
        
        // Obtener una referencia al elemento canvas del DOM
        const $grafica1 = document.querySelector("#grafica1");
        // Pasa los datos desde PHP
        const ultimoValor = <?php echo $ultimoValor ?>;
        const maxValor = <?php echo $maxValor ?>;
        // Calcular el valor restante
        const restante = maxValor - ultimoValor;
        // Crea el conjunto de datos
        const datos1 = {
            labels: ["Humedad Actual", "Restante"],
            datasets: [{
                data: [ultimoValor, restante],
                backgroundColor: ['#4e73df', '#e4e4e4'],
                hoverBackgroundColor: ['#2e59d9', '#cfcfcf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        };
        new Chart($grafica1, {
            type: 'doughnut', // Tipo de gráfico
            data: datos1,
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
                
            },
        });
        
    </script>
    
</body>

</html>
