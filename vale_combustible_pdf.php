<?php
if(!isset($_GET['id'])){
	header('Location: panel.php');
}
$id = $_GET['id'];
require('./fpdf/fpdf.php');
$db = require('db/connect.php');
// Leer datos de la bd
$db->query('SET lc_time_names = "es_MX"');

$stm = $db->prepare('SELECT fecha, proveedor, tipo, ciudadano, justificacion, cantidad FROM vale_combustible WHERE id_vale=?');
$stm->bind_param('i', $id);
$stm->execute();
$stm->bind_result($fecha, $prove, $tipo, $ciud, $just, $cant);
$stm->fetch();

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Image('escudo.jpg', 30, 5, 20);
$pdf->Image('logo_doc.jpg', $pdf->GetPageWidth() - 55, 5, 35);
$pdf->MultiCell(0,6,'PRESIDENCIA MUNICIPAL
	GRAL. ZARAGOZA, NUEVO LEON
	ADMINISTRACION 2021-2024
', 0, 'C');
$pdf->Ln(20);
$pdf->Cell(0,6,'VALE DE COMBUSTIBLE',0, 1, 'C');
$pdf->Ln(10);
$pdf->Cell(($pdf->GetPageWidth() / 2) - 10,6, 'FECHA: ' . $fecha, 0, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() / 2) - 10,6, 'FOLIO: ' . $id, 0, 1, 'C');

$pdf->SetFont('Times','',12);
$pdf->Cell(0,6,'SR. ' . $prove, 0, 1);
$pdf->Cell(0,6,'FAVOR DE SURTIR ' . $cant . ' LTS DE ' . $tipo, 0, 1);
$pdf->Cell(0,6,'AL C. ' . $ciud , 0, 1);
$pdf->Cell(0,6,'JUSTIFICACION: ' . $just , 0, 1);

$pdf->setY(-60, true);
$pdf->Cell(0,5, 'Firmas Autorizadas', 0, 1, 'C');
$pdf->SetDrawColor(0);
$pdf->Line(10, $pdf->GetPageHeight()-40, 100, $pdf->GetPageHeight()-40);
$pdf->Line(110, $pdf->GetPageHeight()-40, 200, $pdf->GetPageHeight()-40);

$pdf->Ln(20);

$pdf->SetFont('Times','B',12);
$pdf->Cell(($pdf->GetPageWidth() / 2) - 10,5, utf8_decode('C.P. OMAR I. PÉREZ HERNÁNDEZ'), 0, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() / 2) - 10,5, utf8_decode('ING. GENARO LÓPEZ GRIMALDO'), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->Cell(($pdf->GetPageWidth() / 2) - 10,5, utf8_decode('TESORERO MUNICIPAL'), 0, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() / 2) - 10,5, utf8_decode('SECRETARIO DEL AYUNTAMIENTO'), 0, 0, 'C');
$pdf->Output();
?>