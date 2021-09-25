<?php

    // Parametros para indicar conexion con la base de datos.
    $db_hostname="localhost";
    $db_username="proyectodbdhcom";
    $db_password="Dygaro512!!&";
    $db_database="proyectodb_dreamhosters_com";
    $port=3306;

    // Realiza la conexion a la base de datos.
    $conexion=mysqli_connect($db_hostname,$db_username,$db_password,"",$port);

    // Verifica la conexion con la base de datos.
    if(mysqli_connect_errno()){
        echo "<br>Fallo al conectar con la base de datos (hostname).<br>";
        exit();
    }

    // Verifica si se encuentra esa base de datos cuando hay conexion.
    mysqli_select_db($conexion,$db_database) or die ("<br>No se encuentra la base de datos (database name).<br>");

    // Permite incorporar mas caracteres.
    mysqli_set_charset($conexion,"utf8");

?>