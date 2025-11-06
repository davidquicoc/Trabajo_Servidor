<?php
session_start();

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
        </div>
    </div>

</body>
</html>