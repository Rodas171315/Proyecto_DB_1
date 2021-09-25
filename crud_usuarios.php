<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>

        <link rel="stylesheet" href="css/hoja.css">
    </head>
    <body>

        <?php
            // Reanuda la sesion del usuario.
            session_start();
            if(!isset($_SESSION["usuario"]))
            {
                header("location:index.php");
            }

            require("conexionDBPDO.php");

            //$conexion=$base->query("SELECT * FROM datos_usuarios");
            //$registros=$conexion->fetchAll(PDO::FETCH_OBJ);
            $registros=$base->query("SELECT * FROM datos_usuarios")->fetchAll(PDO::FETCH_OBJ);

        ?>
        <h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>

        <table width="50%" border="0" align="center">
        <tr >
            <td class="primera_fila">Id</td>
            <td class="primera_fila">Nombre</td>
            <td class="primera_fila">Apellido</td>
            <td class="primera_fila">Dirección</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
        </tr> 
        
            
            <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>

            <td class="bot"><input type='button' name='del' id='del' value='Borrar'></td>
            <td class='bot'><input type='button' name='up' id='up' value='Actualizar'></a></td>
        </tr>       
        <tr>
        <td></td>
            <td><input type='text' name='Nom' size='10' class='centrado'></td>
            <td><input type='text' name='Ape' size='10' class='centrado'></td>
            <td><input type='text' name=' Dir' size='10' class='centrado'></td>
            <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
        </table>

        <p>&nbsp;</p>
        
    </body>
</html>