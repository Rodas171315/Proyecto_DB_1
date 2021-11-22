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
$sqlPersonas = ("SELECT * FROM `personas_registradas` WHERE `CUI`=$cui");
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
    <th>Telefono</th>
    <th>Email</th>
    <th>Opciones</th>
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
    <td><?php echo $data['Telefono']; ?></td>
    <td><?php echo $data['Email']; ?></td>
    <td>
        <a href="user_update.php?cui=<?php echo $data['CUI']; ?>" class="tiny warning button">
        <i class="iconify" data-icon="foundation:pencil"></i>
        </a>
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>

<br>
<hr id="mi_seguimiento">
<h1 id="h1form">Estado del Proceso de Vacunación</h1>
<hr>
<br>

<?php
require('conexionDB.php');
$sqlSeguimiento = ("SELECT * FROM `vista_seguimientos` WHERE `CUI`='$cui' AND `Fecha de Dosis`=(SELECT MAX(`Fecha de Dosis`) FROM `vista_seguimientos` WHERE `CUI`='$cui')");
$queryDataS     = mysqli_query($conexion, $sqlSeguimiento);
?>

<table class="table table-bordered table-striped">
<thead>
    <tr>
    <th>ID</th>
    <th>Codigo de Seguimiento</th>
    <th>Fecha de Vacunacion</th>
    <th>Centro de Vacunacion</th>
    <th>Vacunacion Extranjera</th>
    <th>Ultimo Proceso</th>
    <th>Fecha del Proceso</th>
    <th>Vacuna Aplicada</th>
    </tr>
</thead>
<tbody>
    <?php 
    $i = 1;
    while ($data = mysqli_fetch_array($queryDataS)) { ?>
    <tr>
    <th scope="row"><?php echo $i++; ?></th>
    <td><?php echo $data['Seguimiento']; $seguimiento = $data['Seguimiento'];?></td>
    <td><?php echo $data["Fecha de Vacunacion"]; $fecha_vacuna = $data["Fecha de Vacunacion"];?></td>
    <td><?php echo $data['Centro']; ?></td>
    <td><?php echo $data["Vacunacion Extranjera"]; ?></td>
    <td><?php echo $data['Dosis']; $proceso = $data['Dosis'];?></td>
    <td><?php echo $data["Fecha de Dosis"]; ?></td>
    <td><?php echo $data['Vacuna']; $vacuna = $data['Vacuna'];?></td>
    </tr>
    <?php } ?>
</tbody>
</table>

<br>
<hr id="mi_historial">
<h1 id="h1form">Historial del Proceso de Vacunación</h1>
<hr>
<br>

<?php
require('conexionDB.php');
$sqlHistorial = ("SELECT * FROM `vista_historial` WHERE `id_seguimiento`='$seguimiento'");
$queryDataH   = mysqli_query($conexion, $sqlHistorial);
?>

<table class="table table-bordered table-striped">
<thead>
    <tr>
    <th>ID</th>
    <th>Inscrito/Registrado</th>
    <th>Primera Dosis</th>
    <th>Segunda Dosis</th>
    <th>Tercera Dosis</th>
    <th>Completado</th>
    </tr>
</thead>
<tbody>
    <?php 
    $i = 1;
    while ($data = mysqli_fetch_array($queryDataH)) { ?>
    <tr>
    <th scope="row"><?php echo $i++; ?></th>
    <td><?php echo $data['Inscrito']; ?></td>
    <td><?php echo $data["Primera Dosis"]; ?></td>
    <td><?php echo $data["Segunda Dosis"]; ?></td>
    <td><?php echo $data["Tercera Dosis"]; ?></td>
    <td><?php echo $data['Completado']; ?></td>
    </tr>
    <?php } ?>
</tbody>
</table>
<br>

<?php
date_default_timezone_set("America/Guatemala");
$fecha_actual = date("Y-m-d");
// Verifica que la persona tenga completo su proceso de vacunacion.
if($fecha_vacuna>$fecha_actual)
{
    if($proceso=="Completado")
    {
        ?>
        <div class="callout success" id="calloutform">
        <h5>Felicidades! Ya completo su proceso de vacunación.</h5>
        <a href="userView.php#comprobante">Descargar comprobante</a>
        </div>
        <?php
    }
    else
    {
        $date1 = new DateTime("$fecha_actual");
        $date2 = new DateTime("$fecha_vacuna");
        $interval = $date1->diff($date2);
        //echo "tiempo dividido: ".$interval->y." años, ".$interval->m." meses, ".$interval->d." días.";
        ?>
        <div class="callout warning" id="calloutform">
        <h5>Tiempo restante para la fecha de vacunación:<?php echo " ".$interval->days." "; ?>días.</h5>
        <a href="userView.php#comprobante">Descargar historial</a>
        </div>
        <?php
    }
}
if($fecha_vacuna=='')
{
    ?>
    <div class="callout alert" id="calloutform">
    <h5>OJO! Actualmente no tiene permitido vacunarse.</h5>
    <h5>Manténgase al tanto de nuestras noticias para enterarse de las futuras fechas de vacunación.</h5>
    <a href="noticias.php">Ver noticias</a>
    </div>
    <?php
}
else
{
    ?>
    <div class="callout warning" id="calloutform">
    <h5>Ya es hora de ir a vacunarse!</h5>
    <a href="userView.php#comprobante">Descargar historial</a>
    </div>
    <?php
}
?>
<br>

<br>
<hr id="comprobante">
<h1 id="h1form">Comprobante PDF</h1>
<hr>

<form data-abide novalidate name="form_comprobantes" method="POST" action="comprobante.php">
    <input type="hidden" name="cui" id="cui" value="<?php echo $cui; ?>"/>
    <input type="hidden" name="id_seguimiento" id="id_seguimiento" value="<?php echo $seguimiento; ?>"/>
    <div class="text-center mt-5">
    <button class="btn-enviar" type="submit">Generar Comprobante</button>
    </div>
</form>
<br>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>