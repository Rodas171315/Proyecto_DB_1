<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Registro de Usuario</title></head>
<?php require("head.php"); ?>

<body>
<?php require("header.php"); ?>

<div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>

<br>
<hr>
<h1 id="h1form">REGISTRO DE USUARIO</h1>
<hr>
<br>

<form data-abide novalidate name="form_reg_user" method="get" action="registrar_usuario.php">
<table id ="tableform">
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="cui">CUI (DPI):
                <input type="text" name="cui" id="cui" placeholder="1234" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                <span class="form-error">
                    Por favor, ingrese su CUI.
                </span>
                </label>
                <p class="help-text" id="example1Hint1">Ingrese su CUI sin espacios.</p>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="contra">Contraseña:
                <input type="password" name="contra" id="contra" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required >
                <span class="form-error">
                    Por favor, ingrese una contraseña.
                </span>
                </label>
                <p class="help-text" id="example1Hint2">Use 8 o más caracteres con una combinación de letras y números.</p>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="confcontra">Confirmacion de Contraseña: 
                <input type="password" name="confcontra" id="confcontra" placeholder="" aria-describedby="example1Hint3" aria-errormessage="example1Error3" required pattern="alpha_numeric" data-equalto="contra">
                <span class="form-error">
                    ¡Oye, las contraseñas deben coincidir!
                </span>
                </label>
                <p class="help-text" id="example1Hint3">Ingrese nuevamente la contraseña.</p>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="telefono">Número de Teléfono:
                <input type="text" name="telefono" id="telefono" placeholder="1234" aria-describedby="example1Hint4" aria-errormessage="example1Error4" required pattern="number">
                <span class="form-error">
                    Por favor, ingrese su número.
                </span>
                </label>
                <p class="help-text" id="example1Hint4">Ingrese su numero sin espacios ni guiones.</p>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="email">Correo Electrónico:
                    <input type="text" name="email" id="email" placeholder="example@proyectodb.com" required pattern="email">
                    <span class="form-error" data-form-error-on="required">
                        Por favor, ingrese su correo para poder contactarlo.
                    </span>
                    <span class="form-error" data-form-error-on="pattern">
                        Email Inválido
                    </span>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="centro">Elegir centro de vacunación:
                    <select name="centro" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlCentros = ("SELECT * FROM `centros_vacunacion` ORDER BY `id_centro` ASC");
                    $queryData   = mysqli_query($conexion, $sqlCentros);
                    $total_centros = mysqli_num_rows($queryData);
                    
                    echo "<option value=''></option>";
                    while($fila=$queryData->fetch_array()) {
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
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <fieldset class="cell large-2"></fieldset>
                    <fieldset class="cell large-4">
                        <button class="button" type="submit" name="registrar" id="registrar" value="Registrar">Registrar</button>
                    </fieldset>
                    <fieldset class="cell large-4">
                        <button class="button" type="reset" value="Limpiar">Limpiar</button>
                    </fieldset>
                    <fieldset class="cell large-2"></fieldset>
                </div>
            </div>
            </td>
            </tr>
        </div>
    </div>
</table>
</form>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>