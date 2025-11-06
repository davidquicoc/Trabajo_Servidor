<?php

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
        
        <!--INICIO SESIÓN-->
        <div class="form-content active">
            <form action="">
                <h2>Inicio Sesión</h2>

                <input type="email" name="email" id="email" placeholder="Nombre" required>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
                <button type="submit">Enviar</button>
            </form>
        </div>

        <!--REGISTRO-->
        <div class="form-content">
            <form action="">
                <h2>Registarse</h2>

                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                <input type="text" name="dni" id="dni" placeholder="DNI" required>
                <input type="email" name="email" id="email" placeholder="Correo electrónico">
                <input type="password" name="password" id="password" placeholder="Contraseña">
                
                <select name="" id="">
                    <option value="">--Selecciona una opción</option>
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
                
                <button type="submit">Enviar</button>
            </form>
        </div>

    </div>

</body>
</html>