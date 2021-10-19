<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Centro de Vacunacion</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/foundation.css"/>
</head>

<body>
<?php require("header.php"); ?>

    <br>
    <hr>
    <h1 id="h1form">Registro de Centro de Vacunacion</h1>
    <hr>
    <br>

    <form data-abide novalidate name="form_reg_centro" method="get" action="registrar_centro.php">
    <table id="tableform">
        <div data-abide-error class="alert callout" style="display: none;" id="alertform">
            <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
        </div>
        <br>
        <input type="hidden" name="id_centro" id="id_centro" value=""/>
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <tr>
                <td id="tdform">
                <br>
                <div class="cell small-12">
                    <label for="nombre">Nombre del Lugar:
                    <input type="text" name="nombre" id="nombre" placeholder="" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required >
                    <span class="form-error">
                        Por favor, ingrese como se llama el lugar.
                    </span>
                    </label>
                </div>
                </td>
                </tr>
                <tr>
                <td id="tdform">
                <br>
                <div class="cell small-12">
                    <label for="direccion">Direccion del Lugar:
                    <textarea name="direccion" id="direccion" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required ></textarea>
                    <span class="form-error">
                        Por favor, ingrese como llegar al lugar.
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