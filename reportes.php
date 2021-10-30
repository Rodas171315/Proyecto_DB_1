<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Reportes</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerAdmin.php"); ?>

<br>
<hr>
<h1 id="h1form">Descarga de Reportes</h1>
<hr>
<br>

<form data-abide novalidate name="form_reportes" method="get" action="generar_reporte.php">
<table id="tableform">
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
                <label for="reporte">Elegir el Reporte:
                <select name="reporte" id="select" required>
                <option value=""></option>
                <option value="1">Personas Vacunas por Centro</option>
                <option value="2">Detalle de Vacunas por Centro</option>
                <option value="3">Personas Habilitadas sin Registro</option>
                <option value="4">Personas Registradas sin Vacunar</option>
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
                        <button class="button" type="submit" name="descargar" id="descargar" value="Descargar">Descargar</button>
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