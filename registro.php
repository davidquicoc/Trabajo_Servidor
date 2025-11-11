<?php
    
    session_start();

    /* Array para acumular errores */
    $errores =[
        'todos' => $_SESSION['todos_error'] ?? '',
        'nombre' => $_SESSION['nombre_error'] ?? '',
        'apellidos' => $_SESSION['apellidos_error'] ?? '',
        'dni' => $_SESSION['dni_error'] ?? '',
        'dni_incorrecto' => $_SESSION['dni_incorrecto'] ?? '',
        'dni_registrado' => $_SESSION['dni_registrado'] ?? '',
        'email' => $_SESSION['email_error'] ?? '',
        'email_registrado' => $_SESSION['email_registrado'] ?? '',
        'contraseña' => $_SESSION['contraseña_error'] ?? '',
        'bien' => $_SESSION['todos_bien'] ?? '',
        'error_base' => $_SESSION['error_db'] ?? ''
    ];

    session_unset();

    function mostrarErrores($error){
        return !empty($error) ? "<p class='mensaje-error'>$error</p>" : "";
    }

    function mostrarNoErrores($error){
        return !empty($error) ? "<p class='mensaje-correcto'>$error</p>" : "";
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/form-style.css">
    <title>Inicio sesión y registro</title>
</head>
<body>
    
    <div class="content">
        
        <!--REGISTRO-->
        <div class="form-content">
            <form action="register_config.php" method="POST">
                <h2>Registarse</h2>

                <?= mostrarErrores($errores['todos'])?>
                <?= mostrarErrores($errores['nombre'])?>
                <?= mostrarErrores($errores['apellidos'])?>
                <?= mostrarErrores($errores['dni'])?>
                <?= mostrarErrores($errores['dni_incorrecto'])?>
                <?= mostrarErrores($errores['dni_registrado'])?>
                <?= mostrarErrores($errores['email'])?>
                <?= mostrarErrores($errores['email_registrado'])?>
                <?= mostrarErrores($errores['contraseña'])?>
                <?= mostrarErrores($errores['error_base'])?>
                <?= mostrarNoErrores($errores['bien'])?>

                <input type="text" name="nombre" id="nombre" placeholder="Nombre" >
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" >
                <input type="text" name="dni" id="dni" placeholder="DNI" >
                <input type="email" name="email" id="email" placeholder="Correo electrónico" >
                <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" >
                
                <p class="enlace">¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a></p>

                <button type="submit">Enviar</button>
            </form>
        </div>

    </div>

</body>
</html>
