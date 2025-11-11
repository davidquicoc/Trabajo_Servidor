<?php
session_start();

if (isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit();
}

$error = $_SESSION['login-error'] ?? '';
unset($_SESSION['login-error']);
//session_unset();

function errorLogin($error) {
    return !empty($error) ? "<p class='mensaje-error'>$error</p>" : '';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/form-style.css">
    <title>Inicio sesión</title>
</head>
<body>
    
    <div class="content">
        
        <!--INICIO SESIÓN-->
        <div class="form-content">
            <form action="login-confirm.php" method="POST">
                <h2>Inicio Sesión</h2>
                <?= errorLogin($error); ?>
                <input type="email" name="email" id="email" placeholder="Nombre" required>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
                <button type="submit">Enviar</button>
            </form>
            <p class="enlace">No tienes una cuenta. <a href="registro.php">Registrate aquí</a></p>
        </div>
    </div>

</body>
</html>