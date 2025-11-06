<?php
    
    session_start();

    require_once '../Trabajo_Servidor/registro.php';

    $errores =[];


    function validarDNI($dni){
        /* Si el formato no es válido le devuelve un false */
        if(!preg_match('/^[0-9]{8}[A-Z]$/', $dni)){
            return false;
        }

        $numero  = substr($dni, 0, 8);
        $letra = strtoupper(substr($dni, 8, 1));
        $letra_correcta = substr("TRWAGMYFPDXBNJZSQVHLCKE", $numero % 23, 1);
        return $letra === $letra_correcta;

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $dni = trim($_POST['dni']);
        $email = trim($_POST['email']);
        $contraseña = trim($_POST['contraseña']);

        
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inicio sesión y registro</title>
</head>
<body>
    
    <div class="content">
        
        <!--REGISTRO-->
        <div class="form-content">
            <form method="POST" enctype="multipart/form-data">
                <h2>Registarse</h2>

                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                <input type="text" name="dni" id="dni" placeholder="DNI" required>
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
                <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                
                <button type="submit">Enviar</button>
            </form>
        </div>

    </div>

</body>
</html>