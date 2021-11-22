<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Actualizar Personas</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php require("headerAdmin.php"); ?>


<br>
<hr>
<h1 id="h1form">Actualizar Fecha de Vacunacion Masivamente</h1>
<hr>
<br>

<form data-abide novalidate name="form_actualizar" method="get" action="actualizar_fecha_vacuna.php">
<table id ="tableform">
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
                <label>- ESTABLECER FECHA DE VACUNACION -</label>
            </div>
            <br>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="anio">Año para vacunacion:
                    <select name="anio" id="anio" required>
                    <?php
                    echo "<option value=''></option>";
                    date_default_timezone_set("America/Guatemala");
                    $anio = date("Y");
                    for ($x = $anio; $x <= $anio+2; $x++) {
                        echo "<option value='$x'>$x</option>";
                    }    
                    ?>
                    </select>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="mes">Mes para vacunacion:
                    <select name="mes" id="mes" required>
                    <?php
                    echo "<option value=''></option>";
                    $mes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                    for ($x = 1; $x <= 12; $x++) {
                        echo "<option value='$x'>".$mes[$x]."</option>";
                    }    
                    ?>
                    </select>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="dia">Día para vacunacion:
                    <select name="dia" id="dia" required>
                    <?php
                    echo "<option value=''></option>";
                    for ($x = 1; $x <= 31; $x++) {
                        echo "<option value='$x'>$x</option>";
                    }    
                    ?>
                    </select>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label>- PARA LAS PERSONAS -</label>
            </div>
            <br>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="fecha_nacimiento">Nacidas antes de:
                <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="2021" aria-describedby="example1Hint1" pattern="number">
                </label>
                <p class="help-text" id="example1Hint1">Ingrese solamente numeros.</p>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="oficio">Del grupo prioritario:
                    <select name="oficio" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlOficios = ("SELECT * FROM `oficios` ORDER BY `id_oficio` ASC");
                    $queryData   = mysqli_query($conexion, $sqlOficios);
                    $total_oficios = mysqli_num_rows($queryData);
                    
                    echo "<option value=''></option>";
                    echo "<option value='0'>Omitir</option>";
                    while($fila=$queryData->fetch_array()) {
                        foreach($fila as $clave => $valor) {
                            if($clave == "0") {
                                echo "<option value='".($valor)."'>";
                            };
                            if($clave == "1"){
                                echo "".($valor)."</option>";
                            };
                        };
                    };    
                    ?>
                    </select>
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdform">
            <br>
            <div class="cell small-12">
                <label for="enfermedad">Que padezcan una enfermedad:
                    <select name="enfermedad" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlEnfermedades = ("SELECT * FROM `enfermedades` ORDER BY `id_enfermedad` ASC");
                    $queryData2   = mysqli_query($conexion, $sqlEnfermedades);
                    $total_enfermedades = mysqli_num_rows($queryData2);
                    
                    echo "<option value=''></option>";
                    echo "<option value='0'>Omitir</option>";
                    while($fila=$queryData2->fetch_array()) {
                        foreach($fila as $clave => $valor) {
                            if($clave == "0") {
                                echo "<option value='".($valor)."'>";
                            };
                            if($clave == "1"){
                                echo "".($valor)."</option>";
                            };
                        };
                    };    
                    ?>
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
                        <button class="button" type="submit" name="actualizar" id="actualizar" value="Actualizar">Actualizar</button>
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
$sqlPersonas = ("SELECT * FROM `fechas_vacunacion` ORDER BY `cui` ASC");
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
<th>Oficio</th>
<th>Enfermedad</th>
<th>Codigo Seguimiento</th>
<th>Fecha de Vacunacion</th>
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
<td><?php echo $data['Oficio']; ?></td>
<td><?php echo $data['Enfermedad']; ?></td>
<td><?php echo $data["Codigo Seguimiento"]; ?></td>
<td><?php echo $data["Fecha Vacunacion"]; ?></td>
</tr>
<?php } ?>
</tbody>
</table>


<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>