<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>CRUD</title></head>
<?php require("head.php"); ?>

<body>
<?php require("reanudar_sesion.php"); ?>
<?php require("headerlogged.php"); ?>
<?php
    $perfil = $_SESSION["perfil"];
    switch ($perfil) {
        case 0:
            header("location:login.php");
            break;
        case 1:
            header("location:userView.php");
            break;
        case 2:
            require("headerEmp.php");
            break;
        case 3:
            require("headerAdmin.php");
            break;
    }
?>
<?php require('conexionDB.php'); ?>

<br>
<hr id="crud_personas">
<h1 id="h1form">CRUD de Personas</h1>
<hr>
<br>

<?php if(isset($_SESSION['mensaje'])) { ?>
<div class="callout success" data-closable>
    <button class="close-button" aria-label="Close alert" type="button" data-close>
    <span aria-hidden="true">&times;</span>
    </button>
    <p><?= $_SESSION['mensaje']; ?></p>
</div>
<?php  } ?>

<form id="tableform" data-abide novalidate name="form_crud_personas" method="POST" action="crud_create.php">
    <br>
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="small-6 medium-6 large-6 cell">
                <label for="cui_p">CUI:
                <input type="text" name="cui_p" id="cui_p" placeholder="" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                <span class="form-error">Por favor, ingrese el cui de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="primer_nombre">Primer Nombre:
                <input type="text" name="primer_nombre" id="primer_nombre" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required >
                <span class="form-error">Por favor, ingrese el primer nombre de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="segundo_nombre">Segundo Nombre:
                <input type="text" name="segundo_nombre" id="segundo_nombre" placeholder="" aria-describedby="example1Hint3" aria-errormessage="example1Error3" >
                <span class="form-error">Por favor, ingrese el segundo nombre de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="tercer_nombre">Tercer Nombre:
                <input type="text" name="tercer_nombre" id="tercer_nombre" placeholder="" aria-describedby="example1Hint4" aria-errormessage="example1Error4" >
                <span class="form-error">Por favor, ingrese el tercer nombre de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="primer_apellido">Primer Apellido:
                <input type="text" name="primer_apellido" id="primer_apellido" placeholder="" aria-describedby="example1Hint5" aria-errormessage="example1Error5" >
                <span class="form-error">Por favor, ingrese el primer apellido de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="segundo_apellido">Segundo Apellido:
                <input type="text" name="segundo_apellido" id="segundo_apellido" placeholder="" aria-describedby="example1Hint6" aria-errormessage="example1Error6" >
                <span class="form-error">Por favor, ingrese el segundo apellido de la persona.</span>
                </label>
            </div>
            <div class="small-12 medium-12 large-12 cell">
                <label>- ESTABLECER FECHA DE NACIMIENTO -</label>
            </div>
            <div class="small-3 medium-3 large-3 cell">
                <label for="anio">Año:
                    <select name="anio" id="anio" required>
                    <?php
                    echo "<option value=''></option>";
                    date_default_timezone_set("America/Guatemala");
                    $anio = date("Y");
                    for ($x = $anio-100; $x <= $anio; $x++) {
                        echo "<option value='$x'>$x</option>";
                    }    
                    ?>
                    </select>
                </label>
            </div>
            <div class="small-3 medium-3 large-3 cell">
                <label for="mes">Mes:
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
            <div class="small-3 medium-3 large-3 cell">
                <label for="dia">Día:
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
            <div class="small-3 medium-3 large-3 cell">
                <label for="sexo">Sexo:
                    <select name="sexo" id="sexo" required>
                    <option value=''></option>
                    <option value='1'>Hombre</option>
                    <option value='2'>Mujer</option>
                    </select>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="oficio">Oficio:
                    <select name="oficio" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlOficios = ("SELECT * FROM `oficios` ORDER BY `id_oficio` ASC");
                    $queryData   = mysqli_query($conexion, $sqlOficios);
                    $total_oficios = mysqli_num_rows($queryData);
                    
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
            <div class="small-6 medium-6 large-6 cell">
                <label for="enfermedad">Enfermedad:
                    <select name="enfermedad" id="select" required>
                    <?php
                    require('conexionDB.php');
                    $sqlEnfermedades = ("SELECT * FROM `enfermedades` ORDER BY `id_enfermedad` ASC");
                    $queryData2   = mysqli_query($conexion, $sqlEnfermedades);
                    $total_enfermedades = mysqli_num_rows($queryData2);
                    
                    echo "<option value=''></option>";
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
        </div>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="crear_p" id="crear_p" value="Crear_P">Crear</button>
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

<?php
require('conexionDB.php');
$sqlPersonas = ("SELECT * FROM `vista_personas` ORDER BY `cui` ASC");
$queryData   = mysqli_query($conexion, $sqlPersonas);
$total_personas = mysqli_num_rows($queryData);
?>

<h6 id="h6form" class="text-center">
Lista de Personas <strong>(<?php echo $total_personas; ?>)</strong>
</h6>

<div class="table-scroll">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Opciones</th>
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
<td>
    <a href="crud_update.php?cui=<?php echo $data['CUI']; ?>" class="small warning button">
    <i class="iconify" data-icon="foundation:pencil"></i>
    </a>
    <a href="crud_delete.php?cui=<?php echo $data['CUI']; ?>" class="tiny alert button">
    <i class="iconify" data-icon="foundation:trash"></i>
    </a>
</td>
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
</div>

<br>
<hr id="crud_usuarios">
<h1 id="h1form">CRUD de Usuarios</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_crud_usuarios" method="POST" action="crud_create_u.php">
    <br>
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="small-6 medium-6 large-6 cell">
                <label for="cui_u">CUI:
                <input type="text" name="cui_u" id="cui_u" placeholder="" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                <span class="form-error">Por favor, ingrese el cui de la persona.</span>
                </label>
                <p class="help-text" id="example1Hint1">Ingrese el CUI sin espacios.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
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
            <div class="small-6 medium-6 large-6 cell">
                <label for="contra">Contraseña:
                <input type="password" name="contra" id="contra" placeholder="" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required >
                <span class="form-error">
                    Por favor, ingrese una contraseña.
                </span>
                </label>
                <p class="help-text" id="example1Hint2">Use 8 o más caracteres con una combinación de letras y números.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="confcontra">Confirmacion de Contraseña: 
                <input type="password" name="confcontra" id="confcontra" placeholder="" aria-describedby="example1Hint3" aria-errormessage="example1Error3" required pattern="alpha_numeric" data-equalto="contra">
                <span class="form-error">
                    ¡Oye, las contraseñas deben coincidir!
                </span>
                </label>
                <p class="help-text" id="example1Hint3">Ingrese nuevamente la contraseña.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="telefono">Número de Teléfono:
                <input type="text" name="telefono" id="telefono" placeholder="1234" aria-describedby="example1Hint4" aria-errormessage="example1Error4" required pattern="number">
                <span class="form-error">
                    Por favor, ingrese un número.
                </span>
                </label>
                <p class="help-text" id="example1Hint4">Ingrese un numero sin espacios ni guiones.</p>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="email">Correo Electrónico:
                    <input type="text" name="email" id="email" placeholder="example@proyectodb.com" required pattern="email">
                    <span class="form-error" data-form-error-on="required">
                        Por favor, ingrese un correo para poder contactarlo.
                    </span>
                    <span class="form-error" data-form-error-on="pattern">
                        Email Inválido
                    </span>
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <fieldset class="small-1 medium-1 large-1 cell"></fieldset>
            <fieldset class="small-4 medium-4 large-4 cell">
                <button class="button" type="submit" name="crear_u" id="crear_u" value="Crear_U">Crear</button>
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

<?php
require('conexionDB.php');
if($perfil==3){
    $sqlUsuarios = ("SELECT * FROM `crud_usuarios` ORDER BY `cui` ASC");
} else { $sqlUsuarios = ("SELECT * FROM `crud_usuarios` WHERE `Perfil`='Cliente' ORDER BY `cui` ASC"); }
$queryDataU   = mysqli_query($conexion, $sqlUsuarios);
$total_usuarios = mysqli_num_rows($queryDataU);
?>

<h6 id="h6form" class="text-center">
Lista de Usuarios <strong>(<?php echo $total_usuarios; ?>)</strong>
</h6>

<div class="table-scroll">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Opciones</th>
<th>ID</th>
<th>CUI</th>
<th>Nombre Completo</th>
<th>Telefono</th>
<th>Email</th>
<th>Perfil</th>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
while ($data = mysqli_fetch_array($queryDataU)) { ?>
<tr>
<td>
    <a href="crud_update_u.php?cui=<?php echo $data['CUI']; ?>" class="small warning button">
    <i class="iconify" data-icon="foundation:pencil"></i>
    </a>
    <a href="crud_delete.php?cui=<?php echo $data['CUI']; ?>" class="tiny alert button">
    <i class="iconify" data-icon="foundation:trash"></i>
    </a>
</td>
<th scope="row"><?php echo $i++; ?></th>
<td><?php echo $data['CUI']; ?></td>
<td><?php echo $data["Nombre Completo"]; ?></td>
<td><?php echo $data['Telefono']; ?></td>
<td><?php echo $data['Email']; ?></td>
<td><?php echo $data['Perfil']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>