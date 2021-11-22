<a href="actualizar.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $anio=$_GET["anio"];
    $mes=$_GET["mes"];
    $dia=$_GET["dia"];
    $fecha_nacimiento=$_GET["fecha_nacimiento"];
    $id_oficio=$_GET["oficio"];
    $id_enfermedad=$_GET["enfermedad"];

    // Query para manipular la base de datos.
    $consulta="CALL `ESTABLECER_FECHA_VACUNA`('$anio-$mes-$dia','$fecha_nacimiento-01-01', $id_oficio, $id_enfermedad)";
    
    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

    // Verifica si se ha realizado el registro.
    if($resultados==false)
    {
        echo "<br>Error al establecer la fecha de vacunacion de las personas.<br>";
    }
    else
    { 
        echo "<br>La fecha de vacunacion de las personas se ha establecido correctamente.<br>";
    }
    
    // Devuelve al formulario
    header("location:actualizar.php");
?>