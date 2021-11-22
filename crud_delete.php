<?php

require('conexionDB.php');

if(isset($_GET['cui']))
{
    $cui = $_GET['cui'];

    $borrarData = ("CALL BORRAR_PERSONAS($cui)");
    $result_borrar = mysqli_query($conexion, $borrarData);
    if(!$result_borrar){
        die("Fallo en la consulta!");
    }

    $_SESSION['mensaje'] = 'Persona eliminada correctamente';
    $_SESSION['mensaje_tipo'] = 'alert';
}

// Devuelve al formulario
header("location:crud.php");

?>