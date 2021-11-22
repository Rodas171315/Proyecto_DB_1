<a href="login.php">Regresar</a>

<?php
    try
    {
        require("conexionDBPDO.php");
        // Query para consulta de credenciales en la base de datos.
        $sql="SELECT * FROM `usuarios` WHERE `cui`= :login AND `contra`= :password";
        $resultado=$base->prepare($sql);
        // Convierte cualquier simbolo en html y luego cualquier caracter que introdujo el usuario.
        $login=htmlentities(addslashes($_POST["login"]));
        $password=htmlentities(addslashes($_POST["password"]));

        $resultado->bindValue(":login", $login);
        $resultado->bindValue(":password", $password);
        $resultado->execute();
        // Comprueba si existe el usuario en la base de datos.
        $numero_registro=$resultado->rowCount();

        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
            $i = $registro['id_perfil'];
        }

        if($numero_registro!=0)
        {
            //echo "<h2>Bienvenido!</h2>";
            // Crea una sesion y alberga su CUI como usuario.
            session_start();
            $_SESSION["usuario"]=$_POST["login"];
            $_SESSION["perfil"]=$i;
            
            switch ($i) {
                case 0:
                    header("location:login.php");
                    break;
                case 1:
                    header("location:userView.php");
                    break;
                case 2:
                    header("location:empView.php");
                    break;
                case 3:
                    header("location:adminView.php");
                    break;
            }
        }
        else
        {
            header("location:login.php");
        }
    }
    catch(Exception $e)
    {
        die("Error" . $e->getMessage());
        echo "Linea del error" . $e->getLine();
    }
?>