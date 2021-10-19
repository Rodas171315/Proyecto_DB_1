<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto DB 1</title>
</head>
<body>
<?php
    try
    {
        // Conexion a la base de datos por PDO.
        $base=new PDO("mysql:host=localhost; dbname=proyectodb_dreamhosters_com", "proyectodbdhcom", "Dygaro512!!&");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Query para consulta de credenciales en la base de datos.
        $sql="SELECT * FROM usuarios WHERE dpi= :login and contra= :password";
        $resultado=$base->prepare($sql);
        // Convierte cualquier simbolo en html y luego cualquier caracter que introdujo el usuario.
        $login=htmlentities(addslashes($_POST["login"]));
        $password=htmlentities(addslashes($_POST["password"]));
        $resultado->bindValue(":login", $login);
        $resultado->bindValue(":password", $password);
        $resultado->execute();
        // Comprueba si existe el usuario en la base de datos.
        $numero_registro=$resultado->rowCount();
        if($numero_registro!=0)
        {
            //echo "<h2>Bienvenido!</h2>";
            // Crea una sesion y alberga su DPI como usuario.
            session_start();
            $_SESSION["usuario"]=$_POST["login"];
            header("location:userView.php");
        }
        else
        {
            header("location:login.php");
        }
    }
    catch(Exception $e)
    {
        die("Error " . $e->getMessage());
    }
?>
</body>
</html>