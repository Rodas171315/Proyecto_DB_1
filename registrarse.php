<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>

        <link rel="stylesheet" href="css/app.css">
        <style>
            h1{
                text-align:center;
            }
            table{
                width: 25%;
                background-color: #FFC;
                border: 2px solid black;
                margin: auto;
            }
            body{
                background-color:#FFC;
            }
            .izq{
                text-align: right;
            }
            .der{
                text-align: left;
            }
            td{
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>

    <body>
    <header>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="userView.php">Usuario</a></li>
            <li><a href="empView.php">Empleado</a></li>
            <li><a href="adminView.php">Admin</a></li>
            <li><a href="login.php">Iniciar Sesion</a></li>
            <li><a href="registrarse.php">Registrarse</a></li>
        </ul>
    </header>
    <br>

    <h1>Registro de Usuario</h1>
        <form name="form_reg_user" method="get" action="registrar_usuario.php">
        <table border="0">
            <tr>
            <td>ID Usuario</td>
            <td><label for="id_user"></label>
            <select id="id_user" name="id_user">
                <option value="" selected>ID</option>
            </select></td>
            </tr>    
            <tr>
            <td>DPI</td>
            <td><label for="dpi"></label>
            <input type="text" name="dpi" id="dpi"></td>
            </tr>
            <tr>
            <td>Contraseña</td>
            <td><label for="contra"></label>
            <input type="text" name="contra" id="contra"></td>
            </tr>
            <tr>
            <td>Perfil Usuario</td>
            <td><label for="perfil"></label>
            <select id="perfil" name="perfil">
                <option value="Cliente" selected>Cliente</option>
            </select></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td><input type="submit" name="enviar" id="enviar" value="Enviar"></td>
            <td><input type="reset" name="borrar" id="borrar" value="Borrar"></td>
            </tr>
        </table>
        </form>
        <br>
    </body>
</html>