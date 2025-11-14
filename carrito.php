<?php 
    require_once 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/carrito.css">
    <title>Carrito</title>
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/7fc225aff5.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-logo">
                <img src="./img/logojd.png">
                <h2>VVOnline</h2>
            </div>
            <div class="header-nav">            
                <?php
                if (isset($_SESSION['nombre'])) {
                    echo "<a href='index.php' title='Inicio'><i class='fa-solid fa-house'></i></a>";
                    echo "<p>" . $_SESSION['nombre'] . "(<a href='logout.php'>Cerrar sesión</a>)</p>";
                } else {
                    echo "<p>Usted no se ha identificado. (<a href='login.php'>Acceder</a>)</p>";
                }
                ?>
            </div>
        </header>
        <main>
            <?php 
                if (!isset($_SESSION['nombre'])){ 
                    echo "<h1 class='encabezado'>Inicia sesión para ver tu carrito</h1>";
                    echo "<p class='carrito_vacio_p'>Aún no has iniciado sesión, hazlo ahora mismo para poder ver tu carrito.</p>";
                    echo "<div class='content_carrito_vacio_a'><a href='login.php' class='carrito_vacio_a'>Inicio Sesión</a></div>";
                    // echo "<h1 class='encabezado'>Inicia sesión para ver tu carrito</h1>";
                    // echo "<a href='login.php'>Inicio Sesión</a>";
                } else {
            ?>
            <h1 class='encabezado'>Tus productos</h1>
            <section class="productos">
                <?php
                    $dni = $_SESSION['dni'];
                    $mostrarProductos = $conn->query("SELECT * FROM carrito WHERE dni = '$dni'");

                    if($mostrarProductos->num_rows > 0){
                        while ($producto = $mostrarProductos->fetch_assoc()) {
                            echo "<div class='producto'>
                                    <div class='img-cuadrada'>
                                        <img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'>
                                    </div>
                                    <h3>" . $producto['nombre'] . "</h3>
                                    <p class='precio'>Precio: " . $producto['precio'] . "€</p>
                                    <p class='descripcion'>" . $producto['descripcion'] . "</p>
                                    <p class='cantidad'>Cantidad: <span>" . $producto['cantidad'] . "</span></p>
                                </div>";
                        }
                        echo "<div class='boton-conteiner'>
                                <form action='borrar_carrito.php' method='POST'>
                                    <input type='hidden' name='dni' value='" . htmlspecialchars($dni) . "'>
                                    <input type='submit' value='Vaciar carrito' class='boton_borrar'>
                                </form>
                                <form action='pagado.php'>
                                    <input type='submit' value='Realizar pago' class='carrito_boton'>
                                </form>
                            </div>";
                    } else {
                        // echo "<h1 class='encabezado'>Tus productos</h1>";
                        echo "<p class='carrito_vacio_p'>Aún no has añadido ningún producto, ve ahora y disfruta de nuestras ofertas.</p>";
                        echo "<div class='content_carrito_vacio_a'><a href='index.php' class='carrito_vacio_a'>Volver a por productos</a></div>";                        
                    }
                }
                ?>
            </section>
        </main>
    </div>
</body>
</html>