<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('recursos/images/Logo_UNIS.jpg',10,10,15);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(35);
        // Título
        $this->Cell(120,10,utf8_decode('Comprobante del Proceso de Vacunación'),1,0,'C');
        // Salto de línea
        $this->Ln(25);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-30);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Fecha y Hora
        date_default_timezone_set("America/Guatemala");
        $DateAndTime = date('d/m/Y h:i:s a', time());
        $this->Cell(0,10,utf8_decode('Impresión: ').$DateAndTime,0,1,'C');
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

require('conexionDB.php');

// Variables para realizar los query, obteniendo datos del formulario.
$cui=$_POST["cui"];
$seguimiento=$_POST["id_seguimiento"];

// Querys para manipular la base de datos y obtener sus resultados.
$sqlSeguimiento = ("SELECT * FROM `vista_seguimientos` WHERE `CUI`='$cui' AND `Seguimiento`='$seguimiento' AND `Fecha de Dosis`=(SELECT MAX(`Fecha de Dosis`) FROM `vista_seguimientos` WHERE `CUI`='$cui')");
$queryDataS     = $conexion->query($sqlSeguimiento);

if($queryDataS==FALSE)
{
    mysqli_close($conexion);
    ?>
    <div class="callout alert" id="calloutform">
    <h5>ERROR!</h5>
    <p>Datos Inválidos.</p>
    <a href="userView.php#comprobante">Regresar</a>
    </div>
    <?php
}
else
{
    $sqlPersonas = ("SELECT * FROM `personas_registradas` WHERE `CUI`=$cui");
    $queryData   = $conexion->query($sqlPersonas);

    $sqlHistorial = ("SELECT * FROM `vista_historial` WHERE `id_seguimiento`='$seguimiento'");
    $queryDataH   = $conexion->query($sqlHistorial);

    mysqli_close($conexion);

    // Crea el documento PDF
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Datos de la Persona
    $pdf->SetFont('Arial','',8);
    while($row = $queryData->fetch_assoc())
    {
        $pdf->Cell(40,10,utf8_decode('Paciente: '.$row["Nombre Completo"]));
        $pdf->Ln(5);
        $pdf->Cell(40,10,utf8_decode('CUI: '.$row['CUI']));
        $pdf->Ln(5);
    }

    // Datos del Seguimiento
    while($row = $queryDataS->fetch_assoc())
    {
        $pdf->Cell(40,10,utf8_decode('Centro de Vacunación: '.$row['Centro']));
        $pdf->Ln(5);
        $pdf->Cell(40,10,utf8_decode('Vacuna Aplicada: '.$row['Vacuna']));
        $pdf->Ln(5);
        if($row["Fecha de Vacunacion"]=='9999-01-01')
        {
            $pdf->Cell(40,10,utf8_decode('Fecha Programada para Vacunación: '.$row['Dosis']));
            $pdf->Ln(15);
        }
        else
        {
            $pdf->Cell(40,10,utf8_decode('Fecha Programada para Vacunación: '.$row["Fecha de Vacunacion"]));
            $pdf->Ln(15);
        }
    }

    // Tabla para el Reporte del Historial de Seguimiento
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(185,10,utf8_decode("Historial de Vacunación"),1,1,'C',0);
    $pdf->Cell(35,10,utf8_decode("Código de Seguimiento"),1,0,'C',0);
    $pdf->Cell(30,10,"Inscrito/Registrado",1,0,'C',0);
    $pdf->Cell(30,10,"Primera Dosis",1,0,'C',0);
    $pdf->Cell(30,10,"Segunda Dosis",1,0,'C',0);
    $pdf->Cell(30,10,"Tercera Dosis",1,0,'C',0);
    $pdf->Cell(30,10,"Completado",1,1,'C',0);
    while($row = $queryDataH->fetch_assoc())
    {
        $pdf->Cell(35,10,$row['id_seguimiento'],1,0,'C',0);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,10,$row['Inscrito'],1,0,'C',0);
        $pdf->Cell(30,10,$row["Primera Dosis"],1,0,'C',0);
        $pdf->Cell(30,10,$row["Segunda Dosis"],1,0,'C',0);
        $pdf->Cell(30,10,$row["Tercera Dosis"],1,0,'C',0);
        $pdf->Cell(30,10,$row['Completado'],1,1,'C',0);
    }

    // Firma y Sello
    $pdf->Image('recursos/images/Firma-y-Sello.jpg',145,120,50);

    $pdf->Output();
}
?>
