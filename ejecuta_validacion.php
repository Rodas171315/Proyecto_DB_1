<?php

function ejecuta_validacion($busqueda)
{
    require("conexionDB.php");

    // Consulta para verificar la existencia del Seguimiento
    $consulta_existe = ("SELECT `id_seguimiento` FROM `seguimientos_persona` WHERE `id_seguimiento`='$busqueda'");
    $resultados_existe = mysqli_query($conexion,$consulta_existe);
    $total_existe = mysqli_num_rows($resultados_existe);

    if($resultados_existe==false || $total_existe==0)
    {
        // Cierra la conexion con la base de datos.
        mysqli_close($conexion);
        ?>
        <div class="callout alert" id="calloutform">
        <h5>ERROR!</h5>
        <p>El seguimiento no existe en la base de datos.</p>
        <a href="validar_comprobante.php#h1form">Regresar</a>
        </div>
        <?php
    }
    else
    {
        // Consulta el Seguimiento de la Persona
        $sqlSeguimiento = ("SELECT * FROM `vista_seguimientos` WHERE `Seguimiento`='$busqueda' AND `Fecha de Dosis`=(SELECT MAX(`Fecha de Dosis`) FROM `vista_seguimientos` WHERE `Seguimiento`='$busqueda')");
        $queryDataS   = mysqli_query($conexion, $sqlSeguimiento);
        $totalS = mysqli_num_rows($queryDataS);

        ?>
        <h6 id="h6form" class="text-center">Estado del Proceso de Vacunación: <?php echo $busqueda; ?> <strong>(<?php echo $totalS; ?>)</strong></h6>
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>ID</th>
            <th>CUI</th>
            <th>Fecha de Vacunacion</th>
            <th>Centro de Vacunacion</th>
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
            <td><?php echo $data['CUI']; $cui = $data['CUI'];?></td>
            <td><?php echo $data["Fecha de Vacunacion"]; ?></td>
            <td><?php echo $data['Centro']; ?></td>
            <td><?php echo $data['Dosis']; ?></td>
            <td><?php echo $data["Fecha de Dosis"]; ?></td>
            <td><?php echo $data['Vacuna']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
        <br>
        <?php

        // Consulta los Datos de la Persona
        $sqlPersona = ("SELECT * FROM `personas_registradas` WHERE `CUI`='$cui'");
        $queryDataP   = mysqli_query($conexion, $sqlPersona);
        $totalP = mysqli_num_rows($queryDataP);

        ?>
        <h6 id="h6form" class="text-center">Datos de la Persona: <?php echo $cui; ?> <strong>(<?php echo $totalP; ?>)</strong></h6>
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
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            while ($data = mysqli_fetch_array($queryDataP)) { ?>
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
            </tr>
            <?php } ?>
        </tbody>
        </table>
        <br>
        <?php

        // Consulta el Historial del Seguimiento
        $sqlHistorial = ("SELECT * FROM `vista_historial` WHERE `id_seguimiento`='$busqueda'");
        $queryDataH   = mysqli_query($conexion, $sqlHistorial);
        $totalH = mysqli_num_rows($queryDataH);
        
        ?>
        <h6 id="h6form" class="text-center">Historial del Proceso de Vacunación: <?php echo $busqueda; ?> <strong>(<?php echo $totalH; ?>)</strong></h6>
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>ID</th>
            <th>Seguimiento</th>
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
            <td><?php echo $data['id_seguimiento']; ?></td>
            <td><?php echo $data['Inscrito']; ?></td>
            <td><?php echo $data["Primera Dosis"]; ?></td>
            <td><?php echo $data["Segunda Dosis"]; ?></td>
            <td><?php echo $data["Tercera Dosis"]; ?></td>
            <td><?php echo $data['Completado']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
        
        <div class="text-center mt-5">
        <a href="empView.php?cui=<?php echo $cui; ?>#h1form"><button class="btn-enviar">Validar Comprobante</button></a>
        </div>
        <?php

    }
}

// Almacena la busqueda del usuario en una variable.
@$busqueda_ingresada=$_GET["seguimiento"];
// Variable para indicar al formulario la pagina a redirigir cuando se envia el formulario.
$pagina_destino=$_SERVER["PHP_SELF"];

?>