<?php
require_once 'config.php';

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['dni']) || !isset($_POST['id_producto']) || !isset($_POST['nombre']) || !isset($_POST['descripcion']) || !isset($_POST['precio']) || !isset($_POST['imagen'])) {
    header("Location: login.php");
    exit();
}

$sql2 = 
$sql1 = "INSERT INTO usuarios (dni, nombre, apellidos, correo, contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if($stmt){
        $stmt->bind_param("sssss", $dni, $nombre, $apellidos, $email, $contraseña_cifrada);
        if($stmt->execute()){
            $_SESSION['todos_bien'] = "Todos los campos están llenos";
        } else {
            if($conn->errno == 1062){
                $_SESSION['error_db'] = "Error: DNI o correo ya registrados";
            } else {
                $_SESSION['error_db'] = "Error al registrar el usuario: " . $conn->error;
            }
        }
        $stmt->close();
    }
header("Location: index.php");
exit();
?>