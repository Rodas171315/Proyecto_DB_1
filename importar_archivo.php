<a href="importar.php">Regresar</a>

<?php
require('conexionDB.php');
$tipo       = $_FILES['Data_Personas']['type'];
$tamanio    = $_FILES['Data_Personas']['size'];
$archivotmp = $_FILES['Data_Personas']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(",", $linea);
       
        $cui                    = !empty($datos[0])  ? ($datos[0]) : '';
        $primer_nombre          = !empty($datos[1])  ? ($datos[1]) : '';
        $segundo_nombre         = !empty($datos[2])  ? ($datos[2]) : '';
        $tercer_nombre          = !empty($datos[3])  ? ($datos[3]) : '';
        $primer_apellido        = !empty($datos[4])  ? ($datos[4]) : '';
        $segundo_apellido       = !empty($datos[5])  ? ($datos[5]) : '';
		$fecha_nacimiento       = !empty($datos[6])  ? ($datos[6]) : '';
        $id_sexo                = !empty($datos[7])  ? ($datos[7]) : '';
        $id_oficio              = !empty($datos[8])  ? ($datos[8]) : '';
        $id_enfermedad          = !empty($datos[9])  ? ($datos[9]) : '';
       
        if( !empty($cui) ){
            $check_duplicidad = ("SELECT cui FROM personas WHERE cui='".($cui)."' ");
            $ca_dupli = mysqli_query($conexion, $check_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }

        //No existen registros duplicados, Ingresa los nuevos registros
        if ( $cant_duplicidad == 0 ) { 
            $insertarData = ("CALL CREAR_PERSONAS($cui,'$primer_nombre','$segundo_nombre','$tercer_nombre','$primer_apellido','$segundo_apellido','$fecha_nacimiento',$id_sexo,$id_oficio,$id_enfermedad)");
            $result_insert = mysqli_query($conexion, $insertarData);   
        } 
        //Caso contrario, Actualiza los registros ya existentes
        else{
            $updateData =  ("CALL ACTUALIZAR_PERSONAS($cui,'$primer_nombre','$segundo_nombre','$tercer_nombre','$primer_apellido','$segundo_apellido','$fecha_nacimiento',$id_sexo,$id_oficio,$id_enfermedad)");
            $result_update = mysqli_query($conexion, $updateData);
        }
    }

    echo '<div>'.$i."). ".$linea.'</div>';
    $i++;
}

echo '<p style="text-aling:center; color:#333;">Total de Registros: '. $cantidad_regist_agregados .'</p>';

// Devuelve al formulario
header("location:importar.php");

?>