<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>

        <link rel="stylesheet" href="css/app.css">
    </head>

    <body>
    <?php
        
        require("conexionDB.php");

        // Variables para realizar el query de registro, obteniendo datos del formulario.
        $id_de=$_GET["id_emp"];
        $dpi=$_GET["dpi"];
        $nombre=$_GET["nombre_emp"];
        $fecha_nacimiento=$_GET["fecha_nace"];
        $email=$_GET["email"];
        $celular=$_GET["celular"];
        $enfermedad_cronica=$_GET["enf_cro"];
        $grupo_prioritario=$_GET["grupo_prio"];
        $proceso_vacuna=$_GET["pro_vac"];
        $programa_vacuna=$_GET["progra_vac"];
        $fecha_dosis=$_GET["fecha_dosis"];

        // Query para manipular la base de datos.
        $consulta="INSERT INTO `datos_empleados` (`id_de`, `dpi`, `nombre`, `fecha_nacimiento`, `email`, `celular`, `enfermedad_cronica`, `grupo_prioritario`, `proceso_vacuna`, `programa_vacuna`, `fecha_dosis`) VALUES ('$id_de', '$dpi', '$nombre', '$fecha_nacimiento', '$email', '$celular', '$enfermedad_cronica', '$grupo_prioritario', '$proceso_vacuna', '$programa_vacuna', '$fecha_dosis')";

        // Obtiene los resultados del query.
        $resultados=mysqli_query($conexion,$consulta);

        // Verifica si se ha realizado el registro.
        if($resultados==false)
        {
            echo "<br>Error al registrar el empleado.<br>";
        }
        else
        {
            echo "<br>El empleado se ha registrado correctamente.<br>";
        }

        require("busqueda_empleado.php");

        busqueda_empleado($dpi);

        // Cierra la conexion con la base de datos.
        mysqli_close($conexion);

    ?>
    </body>
</html>