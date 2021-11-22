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

<br>
<hr>
<h1 id="h1form">Personas Vacunadas en cada Centro de Vacunación entre dos Fechas</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_reportes" method="get" action="generar_reporte.php">
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <input type="hidden" name="id_reporte" value="1" required pattern="number">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="small-12 medium-12 large-12 cell">
                <label>- ESTABLECER PRIMERA FECHA DE VACUNACION -</label>
            </div>
            <br>
            <div class="small-4 medium-4 large-4 cell">
                <label for="anio_p">Año:
                    <select name="anio_p" id="anio_p" required>
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
            <div class="small-4 medium-4 large-4 cell">
                <label for="mes_p">Mes:
                    <select name="mes_p" id="mes_p" required>
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
            <div class="small-4 medium-4 large-4 cell">
                <label for="dia_p">Día:
                    <select name="dia_p" id="dia_p" required>
                    <?php
                    echo "<option value=''></option>";
                    for ($x = 1; $x <= 31; $x++) {
                        echo "<option value='$x'>$x</option>";
                    }    
                    ?>
                    </select>
                </label>
            </div>
            <div class="small-12 medium-12 large-12 cell">
                <label>- ESTABLECER SEGUNDA FECHA DE VACUNACION -</label>
            </div>
            <br>
            <div class="small-4 medium-4 large-4 cell">
                <label for="anio_s">Año:
                    <select name="anio_s" id="anio_s" required>
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
            <div class="small-4 medium-4 large-4 cell">
                <label for="mes_s">Mes:
                    <select name="mes_s" id="mes_s" required>
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
            <div class="small-4 medium-4 large-4 cell">
                <label for="dia_s">Día:
                    <select name="dia_s" id="dia_s" required>
                    <?php
                    echo "<option value=''></option>";
                    for ($x = 1; $x <= 31; $x++) {
                        echo "<option value='$x'>$x</option>";
                    }    
                    ?>
                    </select>
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="descargar" id="descargar" value="Descargar">Descargar</button>
            </fieldset>
            <fieldset class="small-2 medium-2 large-2 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="reset" value="Limpiar">Limpiar</button>
            </fieldset>
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
        </div>
    </div>
</form>
<br><br>

<br>
<hr>
<h1 id="h1form">Detalle de Vacunas en determinado Centro de Vacunación</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_reportes" method="get" action="generar_reporte.php">
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <input type="hidden" name="id_reporte" value="2" required pattern="number">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <br>
            <div class="small-12 medium-12 large-12 cell">
                <label for="centro">Elegir centro de vacunación:
                    <select name="centro" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlCentros = ("SELECT * FROM `centros_vacunacion` ORDER BY `id_centro` ASC");
                    $queryData   = mysqli_query($conexion, $sqlCentros);
                    $total_centros = mysqli_num_rows($queryData);
                    
                    echo "<option value=''></option>";
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
        </div>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="descargar" id="descargar" value="Descargar">Descargar</button>
            </fieldset>
            <fieldset class="small-2 medium-2 large-2 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="reset" value="Limpiar">Limpiar</button>
            </fieldset>
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
        </div>
    </div>
</form>
<br><br>

<br>
<hr>
<h1 id="h1form">Personas Habilitadas para Vacunacion sin Registrar</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_reportes" method="get" action="generar_reporte.php">
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <input type="hidden" name="id_reporte" value="3" required pattern="number">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="descargar" id="descargar" value="Descargar">Descargar</button>
            </fieldset>
            <fieldset class="small-2 medium-2 large-2 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="reset" value="Limpiar">Limpiar</button>
            </fieldset>
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
        </div>
    </div>
</form>
<br><br>

<br>
<hr>
<h1 id="h1form">Personas Registradas Faltantes de Vacunarse segun Fase</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_reportes" method="get" action="generar_reporte.php">
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <input type="hidden" name="id_reporte" value="4" required pattern="number">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="small-12 medium-12 large-12 cell">
                <label for="tipo_dosis">Elegir Fase de Vacunacion:
                    <select name="tipo_dosis" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlTipos = ("SELECT * FROM `tipos_dosis` ORDER BY `id_dosis_recibida` ASC");
                    $queryData   = mysqli_query($conexion, $sqlTipos);
                    $total_tipos = mysqli_num_rows($queryData);
                    
                    echo "<option value=''></option>";
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
        </div>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="descargar" id="descargar" value="Descargar">Descargar</button>
            </fieldset>
            <fieldset class="small-2 medium-2 large-2 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="reset" value="Limpiar">Limpiar</button>
            </fieldset>
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
        </div>
    </div>
</form>
<br><br>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>