<a href="registro.php">Regresar</a>

<?php
    
    require("conexionDB.php");

    // Variables para realizar la comprobacion y registro, obteniendo datos del formulario.
    $cui=$_GET["cui"];
    $contra=$_GET["contra"];
    $telefono=$_GET["telefono"];
    $email=$_GET["email"];
    $id_centro=$_GET["centro"];

    date_default_timezone_set("America/Guatemala");
    $fecha = date("Ymd");
    $id_seguimiento = $fecha.$cui;

    // Query para manipular la base de datos.
    $consulta_apto = ("SELECT `Habilitado` FROM `personas_habilitadas` WHERE `CUI`='$cui'");

    // Obtiene los resultados del query.
    $resultados_apto = mysqli_query($conexion,$consulta_apto);
    $total_apto = mysqli_num_rows($resultados_apto);

    // Verifica si se encuentra la persona habilitada.
    if($resultados_apto==false || $total_apto==0)
    {
        // Cierra la conexion con la base de datos.
        mysqli_close($conexion);

        echo "<br>Error! La persona no se encuentra habilitada para poder registrarse.<br>";
        // Reubica en el home
        //header("location:index.php");
    }
    else
    {
        $consulta_check = ("SELECT `Registrado` FROM `personas_registradas` WHERE `CUI`='$cui'");
        $resultados_check = mysqli_query($conexion,$consulta_check);
        $total_check = mysqli_num_rows($resultados_check);

        // Verifica si ya se encuentra la persona registrada.
        if($resultados_check==false || $total_check==0)
        {
            $consulta_insert = ("CALL CREAR_USUARIOS($cui,'$contra',$telefono,'$email',$id_centro,'$id_seguimiento')");
            $resultados_insert = mysqli_query($conexion,$consulta_insert);

            mysqli_close($conexion);

            // Verifica si se ha realizado el registro.
            if($resultados_insert==false)
            {
                echo "<br>Error al registrar el usuario.<br>";
                // Reubica en el registro de usuario
                //header("location:registro.php");
            }
            else
            { 
                ConfirmarRegistro($cui,$telefono,$email,$id_centro);
                echo "<br>En hora buena! La persona se ha registrado correctamente.<br>";
                // Reubica en el inicio de sesion
                header("location:login.php");
            }
        }
        else
        {
            mysqli_close($conexion);
            echo "<br>Error! La persona ya se encuentra registrada.<br>";
            // Reubica en el inicio de sesion
            //header("location:login.php");
        }
    }
    
    function ConfirmarRegistro($cui,$telefono,$email,$id_centro){
        $destinatario = $email; // Receptor
        $decorreo = ""; // Emisor
        $usuario = $cui;
        $asunto = "Usuario creado correctamente en Proyecto DB.";
        $mensaje = "Tus datos -> CUI: $usuario, Telefono: $telefono, Email: $email, Centro de Vacunacion No.: $id_centro.";
        $mensaje .= "\r\n Att.: $usuario.";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Context-type: text/html; charset=utf8\r\n";
        $headers .= "From: Sistema Proyecto DB < no-reply@proyectodb.com >\r\n";
    
        $exito=mail($destinatario,$asunto,$mensaje,$headers);
        // $exito=mail($destinatario,$asunto,$mensaje,$decorreo,$headers);
    
        if($exito){
            echo "Mensaje enviado exitosamente.";
        }
        else{
            echo "Error!";
        }
    }
?>