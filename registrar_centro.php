<a href="registro_centro.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $id_centro=$_GET["id_centro"];
    $centro=$_GET["nombre"];
    $direccion=$_GET["direccion"];
    $cant_vacunas=$_GET["cant_vacunas"];

    // Query para manipular la base de datos.
    $consulta="INSERT INTO `centros_vacunacion` (`id_centro`, `centro`, `direccion`, `cant_vacunas`) VALUES ('$id_centro', '$centro', '$direccion', $cant_vacunas)";

    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Verifica si se ha realizado el registro.
    if($resultados==false)
    {
        echo "<br>Error al registrar el centro de vacunacion.<br>";
    }
    else
    { 
        echo "<br>El centro de vacunacion se ha registrado correctamente.<br>";
        header("location:registro_centro.php");
    }

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

?>