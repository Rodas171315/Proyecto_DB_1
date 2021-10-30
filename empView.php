<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Empleado</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerEmp.php"); ?>


<?php require("ejecuta_busqueda.php"); ?>
<br>
<hr>
<h1 id="h1empView">BUSQUEDA DE USUARIO</h1>
<hr>
<br>

<form data-abide novalidate action="<?php $pagina_destino ?>" method="get">
<table id ="tableempView">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <tr>
            <td id="tdempView">
            <br>
            <div class="cell small-12">
                <label for="buscar">Ingresar CUI (DPI):
                <input type="text" name="buscar" id="buscar" placeholder="1234" pattern="number">
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdempView">
            <br>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <fieldset class="cell large-2"></fieldset>
                    <fieldset class="cell large-4">
                        <button class="button" type="submit" name="enviando" value="Buscar!">Buscar!</button>
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
<br>

<?php

// Comprueba si el formulario esta lleno para realizar una busqueda especializada, de lo contrario, muestra todos los registros. 
if($busqueda_ingresada!=NULL) {
    ejecuta_busqueda($busqueda_ingresada);
}
else {
    $busqueda_ingresada="";
}

?>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>