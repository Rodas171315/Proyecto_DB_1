<?php

require('conexionDB.php');

if(isset($_POST['crear_p']))
{
    $cui = $_POST['cui_p'];
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

    $check_duplicidad = ("SELECT `cui` FROM `personas` WHERE `cui`=$cui");
    $resultado = mysqli_query($conexion, $check_duplicidad);
    $cant_duplicidad = mysqli_num_rows($resultado);

    // Si no existen registros duplicados, ingresa el nuevo registro
    if ( $cant_duplicidad == 0 ) { 
        $insertarData = ("CALL CREAR_PERSONAS($cui,'$primer_nombre','$segundo_nombre','$tercer_nombre','$primer_apellido','$segundo_apellido','$fecha_nacimiento',$id_sexo,$id_oficio,$id_enfermedad)");
        $result_insert = mysqli_query($conexion, $insertarData);
        if(!$result_insert){
            die("Fallo en la consulta!");
        }
        $_SESSION['mensaje'] = 'Persona creada correctamente';
        $_SESSION['mensaje_tipo'] = 'success'; 
    } 
    // Caso contrario, actualiza los registros ya existentes
    else{
        $updateData =  ("CALL ACTUALIZAR_PERSONAS($cui,'$primer_nombre','$segundo_nombre','$tercer_nombre','$primer_apellido','$segundo_apellido','$fecha_nacimiento',$id_sexo,$id_oficio,$id_enfermedad)");
        $result_update = mysqli_query($conexion, $updateData);
        if(!$result_update){
            die("Fallo en la consulta!");
        }
        $_SESSION['mensaje'] = 'Persona actualizada correctamente';
        $_SESSION['mensaje_tipo'] = 'success'; 
    }
}

// Devuelve al formulario
header("location:crud.php");

?>