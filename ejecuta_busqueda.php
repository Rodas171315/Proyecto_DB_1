<?php
    
    function ejecuta_busqueda($busqueda)
    {
        require("conexionDB.php");

        /* -- Tabla de Busqueda mediante arrays asociativos -- */
    
        // $dpi=$_GET["buscar"];

        // Query para manipular la base de datos.
        $consultaArr="SELECT * FROM datos_usuarios WHERE dpi LIKE '%$busqueda%'";

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

    }
    
    /*
    @$busqueda_ingresada=$_GET["buscar"];
    $pagina_destino=$_SERVER["PHP_SELF"];

    if($busqueda_ingresada!=NULL)
    {
        ejecuta_busqueda($busqueda_ingresada);
    }
    else
    {
        echo("<form action='" . $pagina_destino . "' method='get'>
                <label>Ingresar DPI: <input type='text' name='buscar'></label>
                <input type='submit' name='enviando' value='Buscar!'>
                </form>");
    }
    */

    // Almacena la busqueda del usuario en una variable.
    @$busqueda_ingresada=$_GET["buscar"];
    // Variable para indicar al formulario la pagina a redirigir cuando se envia el formulario.
    $pagina_destino=$_SERVER["PHP_SELF"];

?>