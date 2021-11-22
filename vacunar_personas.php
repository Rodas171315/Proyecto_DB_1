<a href="empView.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    //$cui=$_GET["cui"];
    $id_seguimiento=$_GET["seguimiento"];
    $vacunado_extranjero=$_GET["vacunado_extranjero"];
    $id_vacuna=$_GET["vacuna"];

    // Query para manipular la base de datos.
    $consulta="CALL `VACUNAR_PERSONAS`('$id_seguimiento', $vacunado_extranjero, $id_vacuna)";
    
    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

    // Verifica si se ha realizado el registro de vacunacion.
    if($resultados==false)
    {
        echo "<br>Error al vacunar a la persona.<br>";
    }
    else
    { 
        echo "<br>La persona se vacuno correctamente.<br>";
    }
    
    // Devuelve al formulario
    //header("location:empView.php?cui=".$cui."&buscar=Buscar");
    header("location:empView.php");
?>