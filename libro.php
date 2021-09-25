<?php
    function ImprimeMensajeLibro(){
        echo "Este es el mensaje de una funcion dentro de otro documento php <br>";
    }

    function IncrementarVariable(){
        
        //$contador = 0; // Se destruye el valor de la variable una vez terminada la funcion
        static $contador = 0; // Conserva el valor de la variable al terminar la funcion (Solo se ejecuta una vez)
        $contador++;
        echo $contador . "<br>";
    }
?>