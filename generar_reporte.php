<a href="reportes.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $id_reporte=$_GET["reporte"];

    // Query para manipular la base de datos.
    $consulta="CALL `ESCRIBE_REPORTE_3`();";

    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Verifica si se ha realizado el registro.
    if($resultados==false)
    {
        echo "<br>Error al descargar el reporte solicitado.<br>";
    }
    else
    { 
        echo "<br>El reporte se ha descargado correctamente.<br>";
        //header("location:registro_centro.php");
    }

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

?>