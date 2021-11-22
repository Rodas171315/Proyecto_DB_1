<?php

require('conexionDB.php');

if(isset($_GET['cui']))
{
    $cui = $_GET['cui'];

    if(!empty($cui)){
        $sqlPersona = ("SELECT * FROM `personas` INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui` INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui` WHERE `personas`.`cui`='".($cui)."' ");
        $resultado = mysqli_query($conexion, $sqlPersona);
        $total_personas = mysqli_num_rows($resultado);
    }

    if ( $total_personas == 1 ) { 
        $row = mysqli_fetch_array($resultado);
        $primer_nombre = $row['primer_nombre'];
        $segundo_nombre = $row['segundo_nombre'];
        $tercer_nombre = $row['tercer_nombre'];
        $primer_apellido = $row['primer_apellido'];
        $segundo_apellido = $row['segundo_apellido'];
        $fecha_nacimiento = $row['fecha_nacimiento'];
        $id_sexo = $row['id_sexo'];
        $id_oficio = $row['id_oficio'];
        $id_enfermedad = $row['id_enfermedad'];
    } 
    else{
        echo "Error!";
    }
}

if(isset($_POST['actualizar_p']))
{
    $cui = $_POST['cui'];
    $primer_nombre = $_POST['primer_nombre'];
    $segundo_nombre = $_POST['segundo_nombre'];
    $tercer_nombre = $_POST['tercer_nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $anio = $_POST['anio'];
    $mes = $_POST['mes'];
    $dia = $_POST['dia'];
    $id_sexo = $_POST['sexo'];
    $id_oficio = $_POST['oficio'];
    $id_enfermedad = $_POST['enfermedad'];

    $fecha_nacimiento = $anio.'-'.$mes.'-'.$dia;

    $updateData =  ("CALL ACTUALIZAR_PERSONAS($cui,'$primer_nombre','$segundo_nombre','$tercer_nombre','$primer_apellido','$segundo_apellido','$fecha_nacimiento',$id_sexo,$id_oficio,$id_enfermedad)");
    $result_update = mysqli_query($conexion, $updateData);
    if(!$result_update){
        die("Fallo en la consulta!");
    }

    // Devuelve al formulario
    header("location:crud.php");
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Actualizar Personas</title></head>
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
<hr>
<h1 id="h1form">Actualizar Personas</h1>
<hr>
<br>

<form id="tableform" data-abide novalidate name="form_crud_personas" method="POST" action="crud_update.php?=<?php echo $_GET['cui']; ?>">
    <br>
    <div data-abide-error class="alert callout" style="display: none;" id="alertform">
        <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
    </div>
    <br>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="small-6 medium-6 large-6 cell">
                <label for="cui">CUI:
                <input type="text" name="cui" id="cui" value="<?php echo $cui; ?>" placeholder="<?php echo $cui; ?>" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
                <span class="form-error">Por favor, ingrese el cui de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="primer_nombre">Primer Nombre:
                <input type="text" name="primer_nombre" id="primer_nombre" value="<?php echo $primer_nombre; ?>" placeholder="<?php echo $primer_nombre; ?>" aria-describedby="example1Hint2" aria-errormessage="example1Error2" required >
                <span class="form-error">Por favor, ingrese el primer nombre de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="segundo_nombre">Segundo Nombre:
                <input type="text" name="segundo_nombre" id="segundo_nombre" value="<?php echo $segundo_nombre; ?>" placeholder="<?php echo $segundo_nombre; ?>" aria-describedby="example1Hint3" aria-errormessage="example1Error3" >
                <span class="form-error">Por favor, ingrese el segundo nombre de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="tercer_nombre">Tercer Nombre:
                <input type="text" name="tercer_nombre" id="tercer_nombre" value="<?php echo $tercer_nombre; ?>" placeholder="<?php echo $tercer_nombre; ?>" aria-describedby="example1Hint4" aria-errormessage="example1Error4" >
                <span class="form-error">Por favor, ingrese el tercer nombre de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="primer_apellido">Primer Apellido:
                <input type="text" name="primer_apellido" id="primer_apellido" value="<?php echo $primer_apellido; ?>" placeholder="<?php echo $primer_apellido; ?>" aria-describedby="example1Hint5" aria-errormessage="example1Error5" >
                <span class="form-error">Por favor, ingrese el primer apellido de la persona.</span>
                </label>
            </div>
            <div class="small-6 medium-6 large-6 cell">
                <label for="segundo_apellido">Segundo Apellido:
                <input type="text" name="segundo_apellido" id="segundo_apellido" value="<?php echo $segundo_apellido; ?>" placeholder="<?php echo $segundo_apellido; ?>" aria-describedby="example1Hint6" aria-errormessage="example1Error6" >
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
                    <option value='<?php echo $id_sexo; ?>'></option>
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
                    
                    echo "<option value='".$id_oficio."'></option>";
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
                    
                   echo "<option value='".$id_enfermedad."'></option>";
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
                <button class="button" type="submit" name="actualizar_p" id="actualizar_p" value="Actualizar_P">Actualizar</button>
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