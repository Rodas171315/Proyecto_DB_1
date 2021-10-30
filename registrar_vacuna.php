<a href="registro_vacuna.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $id_vacuna=$_GET["id_vacuna"];
    $vacuna=$_GET["vacuna"];
    $marca=$_GET["marca"];
    $cant_dosis=$_GET["cant_dosis"];
    $dias_dosis=$_GET["dias_dosis"];

    // Query para manipular la base de datos.
    $consulta="INSERT INTO `vacunas` (`id_vacuna`, `vacuna`, `marca`, `cant_dosis`, `dias_dosis`) VALUES ('$id_vacuna', '$vacuna', '$marca', $cant_dosis, $dias_dosis)";

    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Verifica si se ha realizado el registro.
    if($resultados==false)
    {
        echo "<br>Error al registrar la vacuna.<br>";
    }
    else
    { 
        echo "<br>La vacuna se ha registrado correctamente.<br>";
        header("location:registro_vacuna.php");
    }

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

?>