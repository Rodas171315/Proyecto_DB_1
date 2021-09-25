<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto DB 1</title>

        <style>
            h1{
                text-align:center;
                color:black;
                border-bottom:dotted black;
                width:50%;
                margin:auto; 
            }

            table{
                margin:0 auto;
                border:1px solid black;
                padding:20px 50px;
                margin-top:50px;
            }

            body{
                background-color:#FFC;
            }

            td{
                margin:0 auto;
            }
        </style>
    </head>

    <body>
        <br>
        <h1>Eliminacion de Empleados</h1>
        <form name="form_eli_emp" method="get" action="eliminar_empleado.php">
        <table border="0">
            <tr>
            <td>ID Empleado</td>
            <td><label for="id_emp"></label>
            <input type="text" name="id_emp" id="id_emp"></td>
            </tr>
            <tr>
            <td>DPI</td>
            <td><label for="dpi"></label>
            <input type="text" name="dpi" id="dpi"></td>
            </tr>
            <tr>
            <td>Nombre</td>
            <td><label for="nombre_emp"></label>
            <input type="text" name="nombre_emp" id="nombre_emp"></td>
            </tr>
            <tr>
            <td>Fecha Nacimiento</td>
            <td><label for="fecha_nace"></label>
            <input type="text" name="fecha_nace" id="fecha_nace"></td>
            </tr>
            <tr>
            <td>Email</td>
            <td><label for="email"></label>
            <input type="text" name="email" id="email"></td>
            </tr>
            <tr>
            <td>Celular</td>
            <td><label for="celular"></label>
            <input type="text" name="celular" id="celular"></td>
            </tr>
            <tr>
            <td>Enfermedad Cronica</td>
            <td><label for="enf_cro"></label>
            <select id="enf_cro" name="enf_cro">
                <option value="Ninguna" selected>Ninguna</option>
                <option value="Alzheimer">Alzheimer</option>
                <option value="Diabetes">Diabetes</option>
                <option value="Cancer">Cancer</option>
            </select></td>
            </tr>
            <tr>
            <td>Grupo Prioritario</td>
            <td><label for="grupo_prio"></label>
            <select id="grupo_prio" name="grupo_prio">
                <option value="Ninguno" selected>Ninguno</option>
                <option value="Trabajador de Salud">Trabajador de Salud</option>
                <option value="Trabajador del Estado">Trabajador del Estado</option>
                <option value="Maestro">Maestro</option>
            </select></td>
            </tr>
            <tr>
            <td>Proceso de Vacunacion</td>
            <td><label for="pro_vac"></label>
            <select id="pro_vac" name="pro_vac">
                <option value="Inscrito" selected>Inscrito</option>
                <option value="Primera Dosis">Primera Dosis</option>
                <option value="Segunda Dosis">Segunda Dosis</option>
                <option value="Tercera Dosis">Tercera Dosis</option>
                <option value="Completado">Completado</option>
            </select></td>
            </tr>
            <tr>
            <td>Programa de Vacunacion</td>
            <td><label for="progra_vac"></label>
            <input type="text" name="progra_vac" id="progra_vac"></td>
            </tr>
            <tr>
            <td>Fecha de Dosis</td>
            <td><label for="fecha_dosis"></label>
            <input type="text" name="fecha_dosis" id="fecha_dosis"></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
            <td><input type="reset" name="borrar" id="borrar" value="Borrar"></td>
            </tr>
        </table>
        </form>
        <br>
    </body>
</html>