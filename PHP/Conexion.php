<?php
$host = "localhost";
$user = "root";       
$password = "root";       
$database = "Practicas";

// Crear la conexión
$conexion = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>