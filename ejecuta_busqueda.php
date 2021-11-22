<?php

function ejecuta_busqueda($busqueda)
{
    require("conexionDB.php");

    // Consulta para Verificar Existencia
    $consulta_existe = ("SELECT `cui` FROM `personas` WHERE `cui`='$busqueda'");
    $resultados_existe = mysqli_query($conexion,$consulta_existe);
    $total_existe = mysqli_num_rows($resultados_existe);

    if($resultados_existe==false || $total_existe==0)
    {
        // Cierra la conexion con la base de datos.
        mysqli_close($conexion);
        ?>
        <div class="callout alert" id="calloutform">
        <h5>ERROR!</h5>
        <p>La persona no existe en la base de datos.</p>
        <a href="empView.php#h1form">Regresar</a>
        </div>
        <?php
    }
    else
    {
        // Consulta para Verificar Habilitacion
        $consulta_apto = ("SELECT `Habilitado` FROM `personas_habilitadas` WHERE `CUI`='$busqueda'");
        $resultados_apto = mysqli_query($conexion,$consulta_apto);
        $total_apto = mysqli_num_rows($resultados_apto);

        // Verifica si se encuentra la persona habilitada.
        if($resultados_apto==false || $total_apto==0)
        {
            mysqli_close($conexion);
            ?>
            <div class="callout alert" id="calloutform">
            <h5>ERROR!</h5>
            <p>La persona no se encuentra habilitada para poder registrarse.</p>
            <a href="empView.php#h1form">Regresar</a>
            </div>
            <?php
        }
        else
        {
            // Consulta para Verificar Registro
            $sqlPersona = ("SELECT * FROM `personas_registradas` WHERE `CUI`='$busqueda'");
            $queryDataP   = mysqli_query($conexion, $sqlPersona);
            $totalP = mysqli_num_rows($queryDataP);

            // Verifica si ya se encuentra la persona registrada.
            if($queryDataP==false || $totalP==0)
            {
                mysqli_close($conexion);
                ?>
                <div class="callout alert" id="calloutform">
                <h5>ERROR!</h5>
                <p>La persona no se encuentra registrada aun.</p>
                <a href="empView.php#h1form">Regresar</a>
                </div>
                <?php
            }
            else
            {
                ?>
                <h6 id="h6form" class="text-center">Datos de la Persona: <?php echo $busqueda; ?> <strong>(<?php echo $totalP; ?>)</strong></h6>
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
                    <td><?php echo $data['CUI']; $cui = $data['CUI'];?></td>
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

                // Consulta el Seguimiento de la Persona
                $sqlSeguimiento = ("SELECT * FROM `vista_seguimientos` WHERE `CUI`='$busqueda' AND `Fecha de Dosis`=(SELECT MAX(`Fecha de Dosis`) FROM `vista_seguimientos` WHERE `CUI`='$busqueda')");
                $queryDataS   = mysqli_query($conexion, $sqlSeguimiento);
                $totalS = mysqli_num_rows($queryDataS);

                ?>
                <h6 id="h6form" class="text-center">Seguimiento de la Persona: <?php echo $busqueda; ?> <strong>(<?php echo $totalS; ?>)</strong></h6>
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
                <?php

                date_default_timezone_set("America/Guatemala");
                $fecha_actual = date("Y-m-d");
                // Verifica que la persona cumpla el lapso de tiempo para vacunarse.
                if($fecha_vacuna>$fecha_actual)
                {
                    if($proceso=="Completado")
                    {
                        mysqli_close($conexion);
                        ?>
                        <div class="callout success" id="calloutform">
                        <h5>EN HORA BUENA!</h5>
                        <p>La persona ya completo su proceso de vacunacion.</p>
                        <a href="empView.php#h1form">Regresar</a>
                        </div>
                        <?php
                    }
                    else
                    {
                        mysqli_close($conexion);
                        ?>
                        <div class="callout alert" id="calloutform">
                        <h5>ERROR!</h5>
                        <p>La persona aun no alcanza la fecha para vacunarse.</p>
                        <a href="empView.php#h1form">Regresar</a>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>

                    <br>
                    <hr>
                    <h1 id="h1form">Registrar Proceso de Vacunacion</h1>
                    <hr>
                    <br>

                    <form data-abide novalidate name="form_vacunar" method="get" action="vacunar_personas.php">
                    <table id ="tableform">
                        <div data-abide-error class="alert callout" style="display: none;" id="alertform">
                            <p><span class="iconify" data-icon="foundation:alert"></span> Hay algunos errores en su formulario.</p>
                        </div>
                        <br>
                        <!--<input type="hidden" name="cui" id="cui" value="<?php //echo $cui; ?>"/>-->
                        <input type="hidden" name="seguimiento" id="seguimiento" value="<?php echo $seguimiento; ?>"/>
                        <div class="grid-container">
                            <div class="grid-x grid-margin-x">
                                <tr>
                                <td id="tdform">
                                <br>
                                <div class="cell small-12">
                                <legend>¿Se vacuno en el extranjero?</legend>
                                    <input type="radio" name="vacunado_extranjero" id="si" value="1"><label for="si">Sí</label>
                                    <input type="radio" name="vacunado_extranjero" id="no" value="0" required><label for="no">No</label>
                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td id="tdform">
                                <br>
                                <div class="cell small-12">
                                    <label for="vacuna">Aplicar vacuna:
                                        <select name="vacuna" id="select" required>
                                        <?php
                                        require('conexionDB.php');
                                        $sqlVacunas = ("SELECT * FROM `vacunas` ORDER BY `id_vacuna` ASC");
                                        $queryDataV   = mysqli_query($conexion, $sqlVacunas);
                                        
                                        echo "<option value=''></option>";
                                        while($fila=$queryDataV->fetch_array()) {
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
                                <tr>
                                <td id="tdform">
                                <br>
                                <div class="grid-container">
                                    <div class="grid-x grid-margin-x">
                                        <fieldset class="cell large-2"></fieldset>
                                        <fieldset class="cell large-4">
                                            <button class="button" type="submit" name="vacunar" id="vacunar" value="Vacunar">Validar y Vacunar</button>
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
                    mysqli_close($conexion);
                }
            }
        }
    }
}

// Almacena la busqueda del usuario en una variable.
@$busqueda_ingresada=$_GET["cui"];
// Variable para indicar al formulario la pagina a redirigir cuando se envia el formulario.
$pagina_destino=$_SERVER["PHP_SELF"];

?>