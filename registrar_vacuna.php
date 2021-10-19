<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto DB 1</title>
</head>
<body>
<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $id_dv=$_GET["id_dv"];
    $nombre_vac=$_GET["nombre_vac"];
    $marca=$_GET["marca"];
    $cant_dosis=$_GET["cant_dosis"];
    $dias_dosis=$_GET["dias_dosis"];

    // Query para manipular la base de datos.
    $consulta="INSERT INTO `datos_vacuna` (`id_dv`, `nombre_vac`, `marca`, `cant_dosis`, `dias_dosis`) VALUES ('$id_dv', '$nombre_vac', '$marca', '$cant_dosis', '$dias_dosis')";

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
        
        //require("busqueda_global.php");
        //busqueda_global($nombre_vac);
        
        //header("location:login.php");
    }

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

?>
</body>
</html>