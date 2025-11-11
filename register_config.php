<?php

    session_start();
    
    require_once '../Trabajo_Servidor/config.php';


    /* Validaciones */
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $dni = trim($_POST['dni'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contraseña = trim($_POST['contraseña'] ?? '');

    function validarDNI($dniValidar){
        /* Si el formato no es válido le devuelve un false */
        if(!preg_match('/^[0-9]{8}[A-Z]$/', $dniValidar)){
            return false;
        }

        $numero  = substr($dniValidar, 0, 8);
        $letra = strtoupper(substr($dniValidar, 8, 1));
        $letra_correcta = substr("TRWAGMYFPDXBNJZSQVHLCKE", $numero % 23, 1);
        return $letra === $letra_correcta;

    }

    $hay_errores_individuales = false;

    if(empty($nombre) && empty($apellidos) && empty($dni) && empty($email) && empty($contraseña)){
        $_SESSION['todos_error'] = "Todos los campos estan vacíos rellenalos";
        $hay_errores_individuales = true;
    }else{
        
        if(empty($nombre)){
            $_SESSION['nombre_error'] = "Rellena el campo nombre";
            $hay_errores_individuales = true;
        }

        if(empty($apellidos)){
            $_SESSION['apellidos_error'] = "Rellena el campo apellidos";
            $hay_errores_individuales = true;
        }
        
        if(empty($dni)){
            $_SESSION['dni_error'] = "Rellena el campo DNI";
            $hay_errores_individuales = true;
        }else{
            if(!validarDNI($dni)){
                $_SESSION['dni_incorrecto'] = "El formato o la letra del DNI no es válido";
                $hay_errores_individuales = true;
            }else{
                $checkDNI = $conn->query("SELECT dni FROM usuarios WHERE dni = '$dni'");
                if($checkDNI->num_rows > 0){
                    $_SESSION['email_registrado'] = "El email ya esta registrado";
                    $hay_errores_individuales = true;
                }
            }
        }

        if(empty($email)){
            $_SESSION['email_error'] = "Rellena el campo email";
            $hay_errores_individuales = true;
        }else{
            $checkEmail = $conn->query("SELECT correo FROM usuarios WHERE correo = '$email'");
                if($checkDNI->num_rows > 0){
                    $_SESSION['dni_registrado'] = "El DNI ya esta registrado";
                    $hay_errores_individuales = true;
                }
        }
        
        if(empty($contraseña)){
            $_SESSION['contraseña_error'] = "Rellena el campo contraseña";
            $hay_errores_individuales = true;
        }

    }

if(!$hay_errores_individuales){
    $contraseña_cifrada = password_hash($contraseña, PASSWORD_BCRYPT, ['cost' => 10]);

    $sql = "INSERT INTO usuarios (dni, nombre, apellidos, correo, contraseña) VALUES (?, ?, ?, ?, ?)";
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
    } else {
        $_SESSION['error_db'] = "Error en la preparación de la consulta: " . $conn->error;
    }

    header("Location: ../Trabajo_Servidor/registro.php");
    exit();
} else {
    header("Location: ../Trabajo_Servidor/registro.php");
    exit();
}
?>
