<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/foundation.css"/>
</head>

<body>
<?php require("header.php"); ?>

<br>
<hr>
<h1 id="h1login">INICIO DE SESION</h1>
<hr>
<br>

<form data-abide novalidate action="comprobar_login.php" method="post">
<table id ="tablelogin">
    <div data-abide-error class="alert callout" style="display: none;" id="alertlogin">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <tr>
            <td id="tdlogin">
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
            <td id="tdlogin">
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
            <td id="tdlogin">
            <br>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <fieldset class="cell large-2"></fieldset>
                    <fieldset class="cell large-4">
                        <button class="button" type="submit" name="ingresar" value="Ingresar">Ingresar</button>
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