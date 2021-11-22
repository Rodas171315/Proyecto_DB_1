<?php

require('conexionDB.php');

if(isset($_GET['cui']))
{
    $cui = $_GET['cui'];

    if(!empty($cui)){
        $sqlUsuario = ("SELECT * FROM `personas_registradas` INNER JOIN `usuarios` ON `usuarios`.`cui`=`personas_registradas`.`cui` WHERE `personas_registradas`.`cui`='".($cui)."' ");
        $resultado = mysqli_query($conexion, $sqlUsuario);
        $total_usuarios = mysqli_num_rows($resultado);
    }

    if ( $total_usuarios == 1 ) { 
        $row = mysqli_fetch_array($resultado);
        $contra = $row['contra'];
        $telefono = $row['Telefono'];
        $email = $row['Email'];
        $id_perfil = $row['id_perfil'];
    } 
    else{
        echo "Error!";
    }
}

if(isset($_POST['actualizar_u']))
{
    $cui = $_POST['cui'];
    $contra = $_POST['contra'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $id_perfil = $_POST['id_perfil'];

    $updateData =  ("CALL ACTUALIZAR_USUARIOS($cui,'$contra',$telefono,'$email',$id_perfil)");
    $result_update = mysqli_query($conexion, $updateData);
    if(!$result_update){
        die("Fallo en la consulta!");
    }

    // Devuelve al formulario
    header("location:userView.php#mis_datos");
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Actualizar Datos</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php
    $perfil = $_SESSION["perfil"];
    switch ($perfil) {
        case 0:
            header("location:login.php");
            break;
        case 1:
            require("headerUser.php");
            break;
        case 2:
            require("headerEmp.php");
            break;
        case 3:
            require("headerAdmin.php");
            break;
    }
?>
<?php require('conexionDB.php'); ?>

<br>
<hr>
<h1 id="h1form">Actualizar Datos</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_crud_usuarios" method="POST" action="user_update.php?=<?php echo $_GET['cui']; ?>">
    <br>
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <input type="hidden" name="id_perfil" id="id_perfil" value="<?php echo $id_perfil; ?>">
    <input type="hidden" name="cui" id="cui" value="<?php echo $cui; ?>">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="small-6 medium-6 large-6 cell">
                <label for="contra">Nueva Contraseña:
                <input type="password" name="contra" id="contra" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" >
                <span class="form-error">
                    Por favor, ingrese una contraseña.
                </span>
                </label>
                <p class="help-text" id="example1Hint2">Use 8 o más caracteres con una combinación de letras y números.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="confcontra">Confirmacion de Contraseña: 
                <input type="password" name="confcontra" id="confcontra" placeholder="" aria-describedby="example1Hint3" aria-errormessage="example1Error3" pattern="alpha_numeric" data-equalto="contra">
                <span class="form-error">
                    ¡Oye, las contraseñas deben coincidir!
                </span>
                </label>
                <p class="help-text" id="example1Hint3">Ingrese nuevamente la contraseña.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="telefono">Número de Teléfono:
                <input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>" placeholder="<?php echo $telefono; ?>" aria-describedby="example1Hint4" aria-errormessage="example1Error4" pattern="number">
                <span class="form-error">
                    Por favor, ingrese un número.
                </span>
                </label>
                <p class="help-text" id="example1Hint4">Ingrese un numero sin espacios ni guiones.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="email">Correo Electrónico:
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="<?php echo $email; ?>" pattern="email">
                    <span class="form-error" data-form-error-on="required">
                        Por favor, ingrese un correo para poder contactarlo.
                    </span>
                    <span class="form-error" data-form-error-on="pattern">
                        Email Inválido
                    </span>
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="actualizar_u" id="actualizar_u" value="Actualizar_U">Actualizar</button>
            </fieldset>
            <fieldset class="small-2 medium-2 large-2 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="reset" value="Limpiar">Limpiar</button>
            </fieldset>
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
        </div>
    </div>
</form>
<br><br>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>