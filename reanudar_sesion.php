<?php
    // Reanuda la sesion del usuario.
    session_start();
    if(!isset($_SESSION["usuario"]))
    {
        header("location:login.php");
    }
?>