<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>

    </head>
    <body>
        
        <?php
            // Reanuda la sesion del usuario.
            session_start();
            if(!isset($_SESSION["usuario"]))
            {
                header("location:index.php");
            }
            session_destroy();

            header("location:login.php");
        ?>

    </body>
</html>