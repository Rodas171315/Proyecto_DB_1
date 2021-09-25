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

        function busqueda_usuario($busqueda)
        {
            require("conexionDB.php");

            /* -- Tabla de Busqueda mediante arrays asociativos -- */
        
            // $dpi=$_GET["buscar"];

            // Query para manipular la base de datos.
            $consultaArr="SELECT * FROM usuarios WHERE dpi LIKE '%$busqueda%'";

            // Obtiene los resultados del query.
            $resultadosArr=mysqli_query($conexion,$consultaArr);

            echo "<br>";
            // Crea una tabla en html
            echo "<table><caption>Tabla de Datos del Usuario</caption>";
            // Crea los campos de la tabla
            echo "<tr><th>ID</th><th>DPI</th><th>Contraseña</th><th>Perfil</th>";
            // Crea una tabla virtual y recorre todas las tuplas de la tabla
            while(($fila=mysqli_fetch_array($resultadosArr, MYSQLI_ASSOC)) == true)
            {
                echo "<tr>";
                // Recorre todos los atributos de una tupla.
                echo "<td>" . $fila['id_usuario'] . "</td>";
                echo "<td>" . $fila['dpi'] . "</td>";
                echo "<td>" . $fila['contra'] . "</td>";
                echo "<td>" . $fila['perfil'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br>";

            // Cierra la conexion con la base de datos.
            mysqli_close($conexion);

        }
    ?>
    </body>
</html>