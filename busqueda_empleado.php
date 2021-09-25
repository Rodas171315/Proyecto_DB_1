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

        function busqueda_empleado($busqueda)
        {
            require("conexionDB.php");

            /* -- Tabla de Busqueda mediante arrays asociativos -- */
        
            // $dpi=$_GET["buscar"];

            // Query para manipular la base de datos.
            $consultaArr="SELECT * FROM datos_empleados WHERE dpi LIKE '%$busqueda%'";

            // Obtiene los resultados del query.
            $resultadosArr=mysqli_query($conexion,$consultaArr);

            echo "<br>";
            // Crea una tabla en html
            echo "<table><caption>Tabla de Datos del Empleados</caption>";
            // Crea los campos de la tabla
            echo "<tr><th>ID</th><th>DPI</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Email</th><th>Celular</th><th>Enfermedad Cronica</th><th>Grupo Prioritario</th><th>Proceso de Vacunacion</th><th>Programa de Vacunacion</th><th>Fecha para Dosis</th></tr>";
            // Crea una tabla virtual y recorre todas las tuplas de la tabla
            while(($fila=mysqli_fetch_array($resultadosArr, MYSQLI_ASSOC)) == true)
            {
                echo "<tr>";
                // Recorre todos los atributos de una tupla.
                echo "<td>" . $fila['id_de'] . "</td>";
                echo "<td>" . $fila['dpi'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
                echo "<td>" . $fila['email'] . "</td>";
                echo "<td>" . $fila['celular'] . "</td>";
                echo "<td>" . $fila['enfermedad_cronica'] . "</td>";
                echo "<td>" . $fila['grupo_prioritario'] . "</td>";
                echo "<td>" . $fila['proceso_vacuna'] . "</td>";
                echo "<td>" . $fila['programa_vacuna'] . "</td>";
                echo "<td>" . $fila['fecha_dosis'] . "</td>";
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