<?php
    // Termina la sesion del usuario.
    session_start();
    if(!isset($_SESSION["usuario"]))
    {
        header("location:login.php");
    }
    session_destroy();

    header("location:index.php");
?>