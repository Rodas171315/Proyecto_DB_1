<a href="habilitar.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $fecha_nacimiento=$_GET["fecha_nacimiento"];
    $id_oficio=$_GET["oficio"];
    $id_enfermedad=$_GET["enfermedad"];

    // Query para manipular la base de datos.
    $consulta="CALL `HABILITAR_PERSONAS`('$fecha_nacimiento-01-01', $id_oficio, $id_enfermedad)";
    
    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

    // Verifica si se ha realizado el registro.
    if($resultados==false)
    {
        echo "<br>Error al habilitar el o las personas.<br>";
    }
    else
    { 
        echo "<br>El o las personas son aptos para registrarse correctamente.<br>";
    }
    
    // Devuelve al formulario
    header("location:habilitar.php");
?>