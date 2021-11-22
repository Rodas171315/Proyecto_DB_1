<a href="empView.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de busqueda, obteniendo datos del formulario.
    $cui=$_GET["cui"];

    // Query para manipular la base de datos.
    $consulta="SELECT * FROM `vista_personas` WHERE `CUI`='$cui'";
    
    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

    // Verifica si se ha realizado la busqueda.
    if($resultados==false)
    {
        echo "<br>Error al buscar la persona.<br>";
    }
    else
    { 
        echo "<br>La persona se busco correctamente.<br>";
    }
    
    // Devuelve al formulario
    header("location:empView.php");
?>