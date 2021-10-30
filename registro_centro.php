<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Registro de Centro de Vacunacion</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerAdmin.php"); ?>

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
                <label for="nombre">Nombre del lugar:
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
                <label for="direccion">Direccion del lugar:
                <textarea name="direccion" id="direccion" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required ></textarea>
                <br>
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
            <div class="cell small-12">
                <label for="cant_vacunas">Cantidad de vacunas disponibles:
                <input type="text" name="cant_vacunas" id="cant_vacunas" placeholder="1234" aria-describedby="example1Hint3" aria-errormessage="example1Error3" required pattern="number">
                <span class="form-error">
                    Por favor, ingrese un aproximado de las vacunas disponibles del lugar.
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
$sqlCentros = ("SELECT * FROM `centros_vacunacion` ORDER BY `id_centro` ASC");
$queryData   = mysqli_query($conexion, $sqlCentros);
$total_Centros = mysqli_num_rows($queryData);
?>

<h6 id="h6form" class="text-center">
Lista de Centros de Vacunacion <strong>(<?php echo $total_Centros; ?>)</strong>
</h6>


<table class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Nombre del Centro</th>
<th>Direccion</th>
<th>Cantidad de Vacunas</th>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
while ($data = mysqli_fetch_array($queryData)) { ?>
<tr>
<th scope="row"><?php echo $i++; ?></th>
<td><?php echo $data['centro']; ?></td>
<td><?php echo $data['direccion']; ?></td>
<td><?php echo $data['cant_vacunas']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>


<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>