<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/foundation.css"/>
</head>

<body>
<?php require("header.php"); ?>

    <br>
    <hr>
    <h1 id="h1login">REGISTRO DE USUARIO</h1>
    <hr>
    <br>

    <form data-abide novalidate name="form_reg_user" method="get" action="registrar_usuario.php">
    <table id ="tablelogin">
        <div data-abide-error class="alert callout" style="display: none;" id="alertlogin">
            <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
        </div>
        <br>
        <input type="hidden" name="id_user" id="id_user" value=""/>
        <input type="hidden" name="perfil" id="perfil" value="Cliente"/>
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <tr>
                <td id="tdlogin">
                <br>
                <div class="cell small-12">
                    <label for="dpi">CUI (DPI):
                    <input type="text" name="dpi" id="dpi" placeholder="1234" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                    <span class="form-error">
                        Por favor, ingrese su CUI.
                    </span>
                    </label>
                <p class="help-text" id="example1Hint1">Ingrese su CUI sin espacios.</p>
                </div>
                </td>
                </tr>
                <tr>
                <td id="tdlogin">
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
                <td id="tdlogin">
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
                <td id="tdlogin">
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
<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
<script src="js/styleImport.js"></script>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>