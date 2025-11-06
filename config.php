<?php
// conexion.php
$servername = "db";  // Nombre del servicio en docker-compose.yml
$username = "user";  // Usuario configurado en docker-compose
$password = "password";  // Contraseña configurada en docker-compose
$dbname = "Trabajo_Servidor";  // Base de datos configurada en docker-compose

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>