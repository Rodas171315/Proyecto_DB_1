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

        // Query para manipular la base de datos.
        $consulta="SELECT * FROM usuarios";

        // Query para manipular la base de datos con un filtrado.
        // $consulta="SELECT * FROM usuarios WHERE perfil='Admin'";

        // Query para importar datos de un documento SQL
        // $importar="CREATE TABLE IF NOT EXISTS tabla_importada (id_art varchar(4), seccion varchar(11), nombre_art varchar(20)) INSERT INTO tabla_importada (id_art, seccion, nombre_art) VALUES ('AR01', 'DEPORTES', 'BATE'),('AR02', 'FERRETERIA', 'MARTILLO')";

        // Query para Insertar Elementos en tabla datos_usuarios
        // INSERT INTO `datos_usuarios` (`id_du`, `dpi`, `nombre`, `fecha_nacimiento`, `email`, `celular`, `enfermedad_cronica`, `grupo_prioritario`, `proceso_vacuna`, `programa_vacuna`, `fecha_dosis`) VALUES (NULL, '3005204920101', 'Dylan', '1998-12-05', 'rodas171315@unis.edu.gt', '37375277', 'Alzheimer', 'Trabajador de Salud', 'Primera Dosis', '2021-09-25 14:30:00', '2021-10-25');
        
        // Obtiene los resultados del query.
        $resultados=mysqli_query($conexion,$consulta);

        echo "<br>";
        // Crea una tabla en html
        echo "<table><caption>Tabla de Usuarios</caption>";
        // Crea los campos de la tabla
        echo "<tr><th>ID</th><th>DPI</th><th>Contraseña</th><th>Perfil</th></tr>";
        // Crea una tabla virtual y recorre todas las tuplas de la tabla
        while(($fila=mysqli_fetch_row($resultados)) == true)
        {
            echo "<tr>";
            // Recorre todos los atributos de una tupla.
            for ($i=0; $i<count($fila); $i++){
               
                echo "<td>" . $fila[$i] . "</td>";    
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";

        /* -- Tabla mediante arrays asociativos -- */

        // Query para manipular la base de datos.
        $consultaArr="SELECT * FROM datos_usuarios";

        // Obtiene los resultados del query.
        $resultadosArr=mysqli_query($conexion,$consultaArr);

        echo "<br>";
        // Crea una tabla en html
        echo "<table><caption>Tabla de Datos del Usuario</caption>";
        // Crea los campos de la tabla
        echo "<tr><th>ID</th><th>DPI</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Email</th><th>Celular</th><th>Enfermedad Cronica</th><th>Grupo Prioritario</th><th>Proceso de Vacunacion</th><th>Programa de Vacunacion</th><th>Fecha para Dosis</th></tr>";
        // Crea una tabla virtual y recorre todas las tuplas de la tabla
        while(($fila=mysqli_fetch_array($resultadosArr, MYSQLI_ASSOC)) == true)
        {
            echo "<tr>";
            // Recorre todos los atributos de una tupla.
            echo "<td>" . $fila['id_du'] . "</td>";
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

        /* -- Tabla de Busqueda mediante arrays asociativos -- */
        
        // Almacena el dato del formulario de busqueda 
        $dpi=$_GET["buscar"];
        // Query para manipular la base de datos.
        $consultaArr="SELECT * FROM datos_usuarios WHERE dpi LIKE '%$dpi%'";

        // Obtiene los resultados del query.
        $resultadosArr=mysqli_query($conexion,$consultaArr);

        echo "<br>";
        // Crea una tabla en html
        echo "<table><caption>Tabla de Datos del Usuario</caption>";
        // Crea los campos de la tabla
        echo "<tr><th>ID</th><th>DPI</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Email</th><th>Celular</th><th>Enfermedad Cronica</th><th>Grupo Prioritario</th><th>Proceso de Vacunacion</th><th>Programa de Vacunacion</th><th>Fecha para Dosis</th></tr>";
        // Crea una tabla virtual y recorre todas las tuplas de la tabla
        while(($fila=mysqli_fetch_array($resultadosArr, MYSQLI_ASSOC)) == true)
        {
            echo "<tr>";
            // Recorre todos los atributos de una tupla.
            echo "<td>" . $fila['id_du'] . "</td>";
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
    ?>

    </body>
</html>