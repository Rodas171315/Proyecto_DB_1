<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>

        <link rel="stylesheet" href="css/app.css">
    </head>

    <body>
    <header>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="userView.php">Usuario</a></li>
            <li><a href="empView.php">Empleado</a></li>
            <li><a href="adminView.php">Admin</a></li>
            <li><a href="logout.php">Cerrar Sesion</a></li>
            <li><a href="registrarse.php">Registrarse</a></li>
            <li><a href="registrarse.php">CRUD Usuario</a></li>
            <li><a href="form_busqueda.php">Buscar Usuarios</a></li>
        </ul>
    </header>
    <?php

        // Reanuda la sesion del usuario.
        session_start();
        if(!isset($_SESSION["usuario"]))
        {
            header("location:index.php");
        }

    ?>
    </body>
</html>