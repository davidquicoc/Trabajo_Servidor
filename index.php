<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$orden = $_GET['orden'] ?? '';
switch ($orden) {
    case 'id_asc':
        $sql = "SELECT * FROM productos ORDER BY id ASC";
        break;
    case 'id_desc':
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        break;
    case 'precio_asc':
        $sql = "SELECT * FROM productos ORDER BY precio ASC";
        break;
    case 'precio_desc':
        $sql = "SELECT * FROM productos ORDER BY precio DESC";
        break;
    case 'nombre_asc':
        $sql = "SELECT * FROM productos ORDER BY nombre ASC";
        break;
    case 'nombre_desc':
        $sql = "SELECT * FROM productos ORDER BY nombre DESC";
        break;
    default:
        $sql = "SELECT * FROM productos";
}

$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./css/index.css">
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
                    echo "<a href='carrito.php' title='Carrito'><i class='fa-solid fa-cart-shopping'></i></a>";
                    echo "<p>" . $_SESSION['nombre'] . "(<a href='logout.php'>Cerrar sesión</a>)</p>";
                } else {
                    echo "<p>Usted no se ha identificado. (<a href='login.php'>Acceder</a>)</p>";
                }
                ?>
            </div>
        </header>
        <main>
            <h2>Productos disponibles</h2>
            <form method="GET" action="index.php">
                <select name="orden" class="select-sql">
                    <option value="">-- Ordenar por --</option>
                    <option value="id_asc">ID (más antiguos)</option>
                    <option value="id_desc">ID (más nuevos)</option>
                    <option value="precio_asc">Precio (menor a mayor)</option>
                    <option value="precio_desc">Precio (mayor a menor)</option>
                    <option value="nombre_asc">Nombre A-Z</option>
                    <option value="nombre_desc">Nombre Z-A</option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="button-select"><i class="fa-solid fa-filter"></i></button>
            </form>
            <?php
                if (isset($_SESSION['confirmacion-carrito'])) {
                    echo "<p class='mensaje-sql'>" . $_SESSION['confirmacion-carrito'] . "</p>";
                    unset($_SESSION['confirmacion-carrito']);
                }
                ?>
            <section class="productos">
            <?php
                if ($resultado->num_rows > 0) {
                    while ($producto = $resultado->fetch_assoc()) {
                        echo "<div class='producto'>
                            <div class='img-cuadrada'>
                                <img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'>
                            </div>
                            <h3>" . $producto['nombre'] . "</h3>
                            <p class='precio'>Precio: " . $producto['precio'] . " €</p>
                            <p class='descripcion'>" .$producto['descripcion'] . "</p>
                            <form action='añadir-carrito.php' method='POST'>
                                <input type='hidden' name='dni' value='" . $_SESSION['dni'] . "'>
                                <input type='hidden' name='id_producto' value='" .  $producto['id'] . "'>
                                <input type='hidden' name='nombre' value='" . $producto['nombre'] . "'>
                                <input type='hidden' name='descripcion' value='" . $producto['descripcion'] . "'>
                                <input type='hidden' name='precio' value='" . $producto['precio'] . "'>
                                <input type='hidden' name='imagen' value='" . $producto['imagen'] . "'>
                                <input type='submit' class='button-producto' value='Añadir al carrito'>
                            </form>
                        </div>";
                    }
                } else {
                    echo "<p>No hay productos disponibles.</p>";
                }
            ?>
            </section>
        </main>
    </div>
</body>
</html>