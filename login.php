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
    
        <h1>INICIO DE SESION</h1>
        <form action="comprobar_login.php" method="post">
            <table>
                <tr>
                    <td class="izq">
                        DPI:
                    </td>
                    <td class="der">
                        <input type="text" name="login">
                    </td>
                </tr>
                <tr>
                    <td class="izq">
                        Contraseña:
                    </td>
                    <td class="der">
                        <input type="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="ingresar" value="INGRESAR"></td>
                </tr>
            </table>
        </form>

    </body>
</html>