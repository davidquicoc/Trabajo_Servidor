<?php
session_start();
require_once 'config.php';

//  Comprobar conexión a BD "Trabajo_Servidor"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
        } else {
            $_SESSION['login-error'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['login-error'] = "Correo no encontrado.";
    }
} else {
    $_SESSION['login-error'] = "Método de envío no correspondiente.";
}

if (isset($_SESSION['name'])) {
    header("Location: productos.php");
    exit();
}


$error = $_SESSION['login-error'] ?? '';

session_unset();

function errorLogin($error) {
    return !empty($error) ? "<p>$error</p>" : '';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inicio sesión</title>
</head>
<body>
    
    <div class="content">
        
        <!--INICIO SESIÓN-->
        <div class="form-content">
            <form action="login-confirm.php">
                <h2>Inicio Sesión</h2>
                <?= errorLogin($error); ?>
                <input type="email" name="email" id="email" placeholder="Nombre" required>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
                <button type="submit">Enviar</button>
            </form>
            <p>No tienes una cuenta. <a href="register.php">Registrate aquí</a></p>
        </div>
    </div>

</body>
</html>