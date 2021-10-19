<?php
    
    require("conexionDB.php");

    // Variables para realizar el query de registro, obteniendo datos del formulario.
    $id_du=$_GET["id_user"];
    $dpi=$_GET["dpi"];
    $contra=$_GET["contra"];
    $perfil=$_GET["perfil"];

    // Query para manipular la base de datos.
    $consulta="INSERT INTO `usuarios` (`id_usuario`, `dpi`, `contra`, `perfil`) VALUES ('$id_du', '$dpi', '$contra', '$perfil')";

    // Obtiene los resultados del query.
    $resultados=mysqli_query($conexion,$consulta);

    // Cierra la conexion con la base de datos.
    mysqli_close($conexion);

    // Verifica si se ha realizado el registro.
    if($resultados==false)
    {
        echo "<br>Error al registrar el usuario.<br>";
    }
    else
    { 
        echo "<br>El usuario se ha registrado correctamente.<br>";
        
        require("busqueda_usuario.php");
        busqueda_usuario($dpi);
        
        //header("location:login.php");
    }
    
?>