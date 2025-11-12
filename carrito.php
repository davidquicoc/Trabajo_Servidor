<?php 
    require_once 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/carritostyle.css">
    <title>Carrito</title>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-logo">
                <img src="./img/logojd.png">
                <h2>LOGO</h2>
            </div>
            <div class="header-nav">            
                <?php
                if (isset($_SESSION['nombre'])) {
                    echo "<a href='index.php'>Volver a productos</a>";
                    echo "<a href=#><i class='fa-solid fa-cart-shopping'></i></a>";
                    echo "<p>" . $_SESSION['nombre'] . ". <a href='logout.php'>Cerrar sesión</a></p>";
                } else {
                    echo "<p>Usted no se ha identificado. (<a href='login.php'>Acceder</a>)</p>";
                }
                ?>
            </div>
        </header>
        <main>
            <?php
                
            ?>
            <?php 
                $_SESSION['nombre'] = "Homero";
                
                if(!isset($_SESSION['nombre'])){ 
                    echo "<h1 class='encabezado'>Inicia sesión para ver tu carrito</h1>";
                    echo "<a href='login.html'>Inicio Sesión</a>";
                }else{
                    $_SESSION['dni'] = "05309480E";
                    $dni = $_SESSION['dni'];

                    $mostrarProductos = $conn->query("SELECT * FROM carrito WHERE dni = '$dni'");

                    if($mostrarProductos->num_rows > 0){
                        echo "<h1 class='encabezado'>Tus productos</h1>";
                        while ($producto = $mostrarProductos->fetch_assoc()) {
                        echo "<div class='producto'>
                            <div class='img-cuadrada'>
                                <img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'>
                            </div>
                            <h3>'" . $producto['nombre'] . "'</h3>
                            <p class='precio'>Precio: '" . $producto['precio'] . "' €</p>
                            <p class='descripcion'>'" .$producto['descripcion'] . "'</p>
                        </div>";
                    }
                    }else{
                        echo "<p>No hay productos disponibles.</p>";
                    }
                }
            ?>
            

        </main>
    </div>
</body>
</html>