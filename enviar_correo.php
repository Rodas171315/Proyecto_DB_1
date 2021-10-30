<a href="contacto.php">Regresar</a>

<?php
    // correodeprueba1179@gmail.com
    // pruebas9711
    
    $destinatario=$_POST["email"]; // Receptor
    $decorreo=""; // Emisor
    $usuario=$_POST["usuario"];
    $asunto=$_POST["asunto"];
    $mensaje=$_POST["mensaje"];
    $mensaje.=" Att.: $usuario.";
    $headers="MIME-Version: 1.0\r\n";
    $headers.="Context-type: text/html; charset=utf8\r\n";
    $headers.="From: Sistema Proyecto DB < no-reply@proyectodb.com >\r\n";

    $exito=mail($destinatario,$asunto,$mensaje,$headers);
    // $exito=mail($destinatario,$asunto,$mensaje,$decorreo,$headers);

    if($exito){
        echo "Mensaje enviado exitosamente.";
    }
    else{
        echo "Error!";
    }
?>