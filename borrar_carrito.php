<?php 

    session_start();

    require_once 'config.php';

    $dni = $_POST['dni'] ?? '';

    if(empty($dni)){
        $_SESSION['message'] = "DNI vacío";
        header("Location: carrito.php");
        exit();
    }

    $sql = "DELETE FROM carrito WHERE dni = ?";

    $stmt = $conn->prepare($sql);

    if($stmt === false){
        $_SESSION['message'] = "Error en la preparación de la consulta: ".$conn->error;
        header("Location: carrito.php");
        exit();
    }

    $stmt->bind_param("s", $dni);

    if($stmt->execute()){
        if($stmt->affected_rows > 0){
            $_SESSION['message'] = "Carrito vaciado correctamente";
        }else{
            $_SESSION['message'] = "No se encontro ningún producto";
        }
    }else{
        $_SESSION['message'] = "Error al vaciar el carrito:".$stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: carrito.php");
    exit();    
?>