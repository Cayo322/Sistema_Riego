<?php
$databaseHost = 'localhost';
$databaseName = 'sistema_riego';
$databaseUsername = 'root';
$databasePassword = '12345';

// Open a new connection to the MySQL server
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
// Comprueba la conexión
if ($mysqli) {
    echo '<span class="dot"></span>';
} else {
    echo "No se pudo conectar a la base de datos<br>";
}
?>
<style>
    .dot {
        height: 15px;
        width: 15px;
        background-color: green;
        border-radius: 50%;
        display: inline-block;
        animation: blink 1s infinite;
    }

    @keyframes blink {
        0% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style>