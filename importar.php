<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Importar Personas</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerAdmin.php"); ?>


<br>
<hr>
<h1 id="h1form">Importar Personas Masivamente</h1>
<hr>
<br>

<form action="importar_archivo.php" method="POST" enctype="multipart/form-data">
<div class="file-input text-center">
<input type="file" name="Data_Personas" id="file-input" class="file-input__input" accept=".csv"/>
<label class="file-input__label" for="file-input">
<i class="zmdi zmdi-upload zmdi-hc-2x"></i>
<span>Elegir Archivo (*.csv)</span></label>
</div>
<div class="text-center mt-5">
<input type="submit" name="subir" class="btn-enviar" value="Importar"/>
</div>
</form>
<br><br>

<?php
header("Content-Type: text/html;charset=utf-8");
require('conexionDB.php');
$sqlPersonas = ("SELECT * FROM `vista_personas` ORDER BY `cui` ASC");
$queryData   = mysqli_query($conexion, $sqlPersonas);
$total_personas = mysqli_num_rows($queryData);
?>

<h6 id="h6form" class="text-center">
Lista de Personas <strong>(<?php echo $total_personas; ?>)</strong>
</h6>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>CUI</th>
<th>Nombre Completo</th>
<th>Fecha de Nacimiento</th>
<th>Sexo</th>
<th>Oficio</th>
<th>Enfermedad</th>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
while ($data = mysqli_fetch_array($queryData)) { ?>
<tr>
<th scope="row"><?php echo $i++; ?></th>
<td><?php echo $data['CUI']; ?></td>
<td><?php echo $data["Nombre Completo"]; ?></td>
<td><?php echo $data["Fecha de Nacimiento"]; ?></td>
<td><?php echo $data['Sexo']; ?></td>
<td><?php echo $data['Oficio']; ?></td>
<td><?php echo $data['Enfermedad']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>


<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>