<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

// Obtener orden desde GET
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

$carrito = $_SESSION['carrito'] ?? [];
$carritoActivo = !empty($carrito) ? 'carrito-activo' : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/7fc225aff5.js" crossorigin="anonymous"></script>
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
                    echo "<a href='carrito.php'><i class='fa-solid fa-cart-shopping $carritoActivo'></i></a>";
                    echo "<p>" . $_SESSION['nombre'] . ". <a href='logout.php'>Cerrar sesión</a></p>";
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
                <button type="submit" class="button-select">Aplicar</button>
            </form>
            <section class="productos">
            <?php
                if ($resultado->num_rows > 0) {
                    while ($producto = $resultado->fetch_assoc()) {
                        echo "<div class='producto'>
                            <div class='img-cuadrada'>
                                <img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'>
                            </div>
                            <h3>'" . $producto['nombre'] . "'</h3>
                            <p class='precio'>Precio: '" . $producto['precio'] . "' €</p>
                            <p class='descripcion'>'" .$producto['descripcion'] . "'</p>
                            <form action='añadir-carrito.php' method='POST'>
                                <input type='hidden' name='id_producto' value='" .  $producto['id'] . "'>
                                <button type='submit' class='button-producto'>Añadir al carrito</button>
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