<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>
    </head>

    <body>
    <?php
        
        function ImprimeMensaje(){
            echo "Este es el mensaje de una funcion dentro de otro bloque php <br>";
        }

    ?>

    <?php
        /*Esto es un comentario
        de varias lineas.*/
        print "Hola Mundo de PHP <br>"; // Esto es un comentario de una linea.
        // Imprime en pantalla.
        print "Esta es la pagina de pruebas <br>";

        // Declaracion de variables.
        $nombre;
        $apellido = "Rodas";
        $edad = 22;

        /* print es una funcion y echo es una expresion
           print utiliza mas tiempo para imprimir que echo porque realiza mas procesos internos. */
        print "El nombre de usuario es " . $apellido . "<br>";  // Concatenado.
        print "El nombre de usuario es $apellido <br>"; // Incluido.

        echo "La edad del usuario es " . $edad . " años <br>";  // Concatenado.
        echo "La edad del usuario es $edad años <br>"; // Incluido.
        
        /* Diferencia de echo sobre print. */ 
        echo $apellido,$edad . "<br>";

        // Creacion de una funcion.
        function Imprime(){
            echo "Este es el mensaje de una funcion <br>";
        }

        // Llamada a la funcion.
        Imprime();
        ImprimeMensaje();

        // Incluye otro documento pero si hay un error permite seguir ejecutando el resto del programa.
        include ("libro.php");
        // Incluye otro documento pero si hay un error NO permite seguir ejecutando el resto del programa.
        // require ("libro.php");
        ImprimeMensajeLibro();

        IncrementarVariable();
        IncrementarVariable();
        IncrementarVariable();
        IncrementarVariable();

        

    ?>
    </body>
</html>