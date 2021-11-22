<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Actualizar Usuarios</title></head>
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
            header("location:userView.php");
            break;
        case 2:
            require("headerEmp.php");
            break;
        case 3:
            require("headerAdmin.php");
            break;
    }
?>

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
        $id_perfil = $row['id_perfil'];
        $contra = $row['contra'];
        $telefono = $row['Telefono'];
        $email = $row['Email'];
    } 
    else{
        echo "Error!";
    }
}

if(isset($_POST['actualizar_u']))
{
    $cui = $_POST['cui'];
    $id_perfil = $_POST['id_perfil'];
    $contra = $_POST['contra'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $updateData =  ("CALL ACTUALIZAR_USUARIOS($cui,'$contra',$telefono,'$email',$id_perfil)");
    $result_update = mysqli_query($conexion, $updateData);
    if(!$result_update){
        die("Fallo en la consulta!");
    }

    // Devuelve al formulario
    header("location:crud.php#crud_usuarios");
}
?>

<br>
<hr>
<h1 id="h1form">Actualizar Usuarios</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_crud_usuarios" method="POST" action="crud_update_u.php?=<?php echo $_GET['cui']; ?>">
    <br>
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
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
            <div class="small-6 medium-6 large-6 cell">
                <label for="cui">CUI:
                <input type="text" name="cui" id="cui" value="<?php echo $cui; ?>" placeholder="<?php echo $cui; ?>" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                <span class="form-error">Por favor, ingrese el cui del usuario.</span>
                </label>
            </div>
            <?php if($perfil==3){ ?>
            <div class="small-6 medium-6 large-6 cell">
                <label for="id_perfil">Elegir Perfil:
                    <select name="id_perfil" id="select" >
                    <?php
                    require('conexionDB.php');
                    $sqlPerfiles = ("SELECT * FROM `perfiles` ORDER BY `id_perfil` ASC");
                    $queryDataP   = mysqli_query($conexion, $sqlPerfiles);
                    $total_perfiles = mysqli_num_rows($queryDataP);
                    
                    echo "<option value='".$id_perfil."'></option>";
                    while($fila=$queryDataP->fetch_array()) {
                        foreach($fila as $clave => $valor) {
                            if($clave == "0") {
                                echo "<option value='".($valor)."'>";
                            };
                            if($clave == "1"){
                                echo "".($valor)."</option>";
                            };
                        };
                    };    
                    ?>
                    </select>
                </label>
            </div>
            <?php } else { ?> <input type="hidden" name="id_perfil" id="id_perfil" value="<?php echo $id_perfil; ?>"> <?php } ?>
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