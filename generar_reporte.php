<a href="reportes.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query, obteniendo datos del formulario.
    $id_reporte=$_GET["id_reporte"];
    
    // Query para manipular la base de datos.
    switch($id_reporte){
        case 0:
            header("location:login.php");
            break;
        case 1:
            // Variables primer reporte
            $anio_p = $_GET["anio_p"];
            $mes_p = $_GET["mes_p"];
            $dia_p = $_GET["dia_p"];
            $anio_s = $_GET["anio_s"];
            $mes_s = $_GET["mes_s"];
            $dia_s = $_GET["dia_s"];
            $fecha_1 = $anio_p.'-'.$mes_p.'-'.$dia_p;
            $fecha_2 = $anio_s.'-'.$mes_s.'-'.$dia_s;

            $consulta = ("CALL `ESCRIBE_REPORTE_1`('$fecha_1','$fecha_2');");
            break;
        case 2:
            // Variables segundo reporte
            $id_centro = $_GET["centro"];

            $consulta = ("CALL `ESCRIBE_REPORTE_2`($id_centro);");
            break;
        case 3:
            $consulta = ("CALL `ESCRIBE_REPORTE_3`();");
            break;
        case 4:
            // Variables cuarto reporte
            $tipo_dosis = $_GET["tipo_dosis"];

            $consulta = ("CALL `ESCRIBE_REPORTE_4`($tipo_dosis);");
            break;
    }

    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Verifica si se ha realizado el query.
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