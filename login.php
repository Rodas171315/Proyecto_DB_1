<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Inicio de Sesion</title></head>
<?php require("head.php"); ?>

<body>
<?php require("header.php"); ?>

<div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>

<br>
<hr>
<h1 id="h1form">INICIO DE SESION</h1>
<hr>
<br>

<form data-abide novalidate action="comprobar_login.php" method="post">
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
                <label for="login">CUI (DPI):
                <input type="text" name="login" id="login" placeholder="1234" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                <span class="form-error">
                    Por favor, ingrese su CUI sin espacios.
                </span>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="password">Contraseña:
                <input type="password" name="password" id="password" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required >
                <span class="form-error">
                    Por favor, ingrese su contraseña.
                </span>
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
                        <button class="button" type="submit" name="ingresar" id="ingresar" value="Ingresar">Ingresar</button>
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