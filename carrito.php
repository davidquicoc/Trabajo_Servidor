<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./carritostyle.css">
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
                    echo "<a href=#><i class='fa-solid fa-cart-shopping $carritoActivo'></i></a>";
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
            <h1>Inicia sesión para ver tu carrito</h1>

        </main>
    </div>
</body>
</html>