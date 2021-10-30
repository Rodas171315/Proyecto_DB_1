<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Usuario Registrado</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerUser.php"); ?>


<br>
<hr id="mis_datos">
<h1 id="h1form">Mis datos</h1>
<hr>
<br>

<?php
require('conexionDB.php');
$cui=$_SESSION["usuario"];
$sqlPersonas = ("SELECT * FROM `vista_personas` WHERE `cui`=$cui");
$queryData   = mysqli_query($conexion, $sqlPersonas);
?>

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