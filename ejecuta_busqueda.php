<?php
    
    function ejecuta_busqueda($busqueda)
    {
        require("conexionDB.php");

        /* -- Tabla de Busqueda mediante arrays asociativos -- */
    
        // $dpi=$_GET["buscar"];

        // Query para manipular la base de datos.
        $consultaArr="SELECT * FROM `vista_personas` WHERE `cui` LIKE '%$busqueda%'";

        // Obtiene los resultados del query.
        $resultadosArr=mysqli_query($conexion,$consultaArr);

        echo "<br>";
        // Crea una tabla en html
        echo "<table><caption>Tabla de Datos de la Persona " .$busqueda. "</caption>";
        // Crea los campos de la tabla
        echo "<tr><th>CUI</th><th>Nombre Completo</th><th>Fecha de Nacimiento</th><th>Sexo</th><th>Oficio</th><th>Enfermedad</th></tr>";
        // <th>Proceso de Vacunacion</th><th>Fecha de Vacunacion</th></tr>
        // Crea una tabla virtual y recorre todas las tuplas de la tabla
        while(($fila=mysqli_fetch_array($resultadosArr, MYSQLI_ASSOC)) == true)
        {
            echo "<tr>";
            // Recorre todos los atributos de una tupla.
            echo "<td>" . $fila['CUI'] . "</td>";
            echo "<td>" . $fila['Nombre Completo'] . "</td>";
            echo "<td>" . $fila['Fecha de Nacimiento'] . "</td>";
            echo "<td>" . $fila['Sexo'] . "</td>";
            echo "<td>" . $fila['Oficio'] . "</td>";
            echo "<td>" . $fila['Enfermedad'] . "</td>";
            //echo "<td>" . $fila['proceso_vacuna'] . "</td>";
            //echo "<td>" . $fila['fecha_vacuna'] . "</td>";
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