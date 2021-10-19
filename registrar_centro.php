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
    $id_centro=$_GET["id_centro"];
    $nombre=$_GET["nombre"];
    $direccion=$_GET["direccion"];

    // Query para manipular la base de datos.
    $consulta="INSERT INTO `centros_vacuna` (`id_centro`, `nombre`, `direccion`) VALUES ('$id_centro', '$nombre', '$direccion')";

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
        
        //require("busqueda_global.php");
        //busqueda_global($id_centro);
        
        //header("location:login.php");
    }

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

?>
</body>
</html>