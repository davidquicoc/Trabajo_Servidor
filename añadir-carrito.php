<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['dni']) || !isset($_POST['id_producto']) || !isset($_POST['nombre']) || !isset($_POST['descripcion']) || !isset($_POST['precio']) || !isset($_POST['imagen'])) {
    $_SESSION['error_carrito'] = "Datos incompletos para añadir al carrito.";
    header("Location: index.php");
    exit();
}

$dni = $_POST['dni'];
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];
$cantidad = 1;

$checkCarrito = $conn->query("SELECT * FROM carrito WHERE dni = '$dni' AND id_producto = '$id_producto'");

if ($checkCarrito->num_rows > 0) {
    $conn->query("UPDATE carrito SET cantidad = cantidad + 1 WHERE dni = '$dni' AND id_producto = '$id_producto'");
} else {
    $conn->query("INSERT INTO carrito (dni, id_producto, nombre, descripcion, precio, imagen, cantidad) VALUES ('$dni', '$id_producto', '$nombre', '$descripcion', '$precio', '$imagen', '$cantidad')");
}

$_SESSION['confirmacion-carrito'] = $nombre . " añadido al carrito.";
header("Location: index.php");
exit();
?>