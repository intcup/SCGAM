<?php
if(!isset($_GET['id'])){
	header('Location: panel.php');
}
$id = $_GET['id'];
require('./fpdf/fpdf.php');
$db = require('db/connect.php');
// Leer datos de la bd
$db->query('SET lc_time_names = "es_MX"');
$stm = $db->prepare('SELECT Proveedores.nombre, DATE_FORMAT(fecha, "%d de %M del %Y"), CONCAT(Ciudadanos.nombre, " ", Ciudadanos.ap_pat," ", Ciudadanos.ap_mat), ruta_credencial_frente, ruta_credencial_reverso FROM orden_compra LEFT JOIN Proveedores ON Proveedores.id = proveedor LEFT JOIN Ciudadanos ON ciudadano = Ciudadanos.id WHERE id_orden=?');
$stm->bind_param('i', $id);
$stm->execute();
$stm->bind_result($prov, $fecha, $ciudadano, $ruta_f, $ruta_r);
$stm->fetch();
$stm->close();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Image('escudo.png', 30, 5, 20);
$pdf->Image('logo_doc.png', $pdf->GetPageWidth() - 55, 5, 35);
$pdf->MultiCell(0,6,'PRESIDENCIA MUNICIPAL
	GRAL. ZARAGOZA, NUEVO LEON
	ADMINISTRACION 2021-2024
', 0, 'C');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,6, utf8_decode('RFC MGZ850101FC2'), 0, 1, 'C');
$pdf->SetFont('Times','B',16);
$pdf->Ln(20);
$pdf->Cell(0,6, utf8_decode('Nº Orden'), 0, 1, 'R');
$pdf->Cell(0,6, utf8_decode($id), 0, 1, 'R');
$pdf->Ln();
$pdf->Cell(0,6, utf8_decode('Fecha'), 0, 1, 'R');
$pdf->Cell(0,6, utf8_decode($fecha), 0, 1, 'R');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5, 'Para: ' . utf8_decode($prov), 0, 1);
$pdf->Cell(0,5, 'Le suplicamos surta lo siguiente a C. ' . utf8_decode($ciudadano) , 0, 1);
$pdf->Ln();
$pdf->SetFillColor(200);
$pdf->Cell(30,5, 'Cant', 1, 0, 'L', true);
$pdf->Cell(0,5, 'Descripcion', 1, 0, 'L', true);


$stm_det = $db->prepare('SELECT nombre, cantidad FROM productos_orden WHERE id_orden=?');
$stm_det->bind_param('i', $id);
$stm_det->execute();
$stm_det->bind_result($nom_p, $cant_p);
while($stm_det->fetch()){
	$pdf->Ln();
	$pdf->Cell(30,5, utf8_decode($cant_p), 1, 0, 'L');
	$pdf->Cell(0,5, utf8_decode($nom_p), 1, 0, 'L');
}

$pdf->Ln(5);
$pdf->Image($ruta_f, 10, $pdf->getY() + 5, 0, 50);
$pdf->Image($ruta_r, 95, $pdf->getY() + 5, 0, 50);
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
