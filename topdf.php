<?php
session_start();
if(!isset($_SESSION['user'])){
	header("Location: index.php");
}
require('./fpdf/fpdf.php');
$db = require('db/connect.php');
// Leer datos de la bd
$db->query('SET lc_time_names = "es_MX"');
$stm = $db->prepare('SELECT CONCAT(nombre, " ", ap_pat), descripcion, domicilio, DAY(fecha), MONTHNAME(fecha), YEAR(fecha), motivo FROM Apoyos LEFT JOIN Ciudadanos ON Apoyos.ciudadano = Ciudadanos.id WHERE Apoyos.id=?');
if(!isset($_GET['id'])){
	header("Location: index.php");
}
$id = $_GET['id'];
$stm->bind_param('i', $id);
$stm->execute();
$stm->bind_result($nombre, $descripcion, $domicilio, $dia, $mes, $anio, $motivo);
$stm->fetch();

$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image('escudo.jpg', 30, 5, 20);
$pdf->Image('logo_doc.jpg', $pdf->GetPageWidth() - 55, 5, 35);
$pdf->SetFont('Times','B',16);
$pdf->MultiCell(0,6,'PRESIDENCIA MUNICIPAL
	GRAL. ZARAGOZA, NUEVO LEON
	ADMINISTRACION 2021-2024
', 0, 'C');
$pdf->Ln(20);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0, 6, 
	utf8_decode(
	"Gral Zaragoza Nuevo Leon
	A $dia de $mes de $anio
	Asunto: Solicitud
	"), 0, 'R');
$pdf->MultiCell(0, 6, 
	utf8_decode(
	"Arq. Juan Arturo Guevara Soto
	Presidente Municipal
	Presente:
	"), 0, 'L');
$pdf->Write(6, "El (la) que suscribe la presente C. $nombre Con domicilio en: $domicilio
Por este medio me dirijo a usted de la manera mas atenta y cordial, para solicitarle en la medida de sus posibilidades, tenga a bien otorgarme un apoyo que consiste en $descripcion por el siguiente motivo: $motivo
	");
$pdf->Ln(60);
$pdf->SetFont('Times','B',12);
$pdf->Cell(0, 6, "Atentamente", 0, 1, 'C');
$pdf->SetDrawColor(0);
$pdf->Line(60,$pdf->GetY() + 30,$pdf->GetPageWidth()-60, $pdf->GetY() + 30);
$pdf->Output();
?>
