<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Registro de Vacunas</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerAdmin.php"); ?>

<br>
<hr>
<h1 id="h1form">Registro de Vacunas</h1>
<hr>
<br>

<form data-abide novalidate name="form_reg_vacuna" method="get" action="registrar_vacuna.php">
<table id="tableform">
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <input type="hidden" name="id_vacuna" id="id_vacuna" value=""/>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="vacuna">Nombre de la Vacuna:
                <input type="text" name="vacuna" id="vacuna" placeholder="" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required >
                <span class="form-error">
                    Por favor, ingrese como se llama la vacuna.
                </span>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="marca">Marca, Fabricante o Desarrollador:
                <input type="text" name="marca" id="marca" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required >
                <span class="form-error">
                    Por favor, ingrese como se llama la marca.
                </span>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="cant_dosis">Cantidad de dosis requerida:
                <select name="cant_dosis" id="select" required>
                <option value=""></option>
                <option value="1">1 dosis</option>
                <option value="2">2 dosis</option>
                <option value="3">3 dosis</option>
                </select>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="dias_dosis">Dias para la siguiente dosis
                <input type="text" name="dias_dosis" id="dias_dosis" placeholder="123" aria-describedby="exampleHelpTextNumber" required pattern="number">
                <span class="form-error">
                    Por favor, ingrese los dias requeridos para recibir la siguiente dosis.
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
<br><br>

<?php
require('conexionDB.php');
$sqlVacunas = ("SELECT * FROM `vacunas` ORDER BY `id_vacuna` ASC");
$queryData   = mysqli_query($conexion, $sqlVacunas);
$total_Vacunas = mysqli_num_rows($queryData);
?>

<h6 id="h6form" class="text-center">
Lista de Vacunas <strong>(<?php echo $total_Vacunas; ?>)</strong>
</h6>


<table class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Vacuna</th>
<th>Marca</th>
<th>Dosis Requeridas</th>
<th>Dias entre Dosis</th>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
while ($data = mysqli_fetch_array($queryData)) { ?>
<tr>
<th scope="row"><?php echo $i++; ?></th>
<td><?php echo $data['vacuna']; ?></td>
<td><?php echo $data['marca']; ?></td>
<td><?php echo $data['cant_dosis']; ?></td>
<td><?php echo $data['dias_dosis']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>


<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>