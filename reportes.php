<?php
session_start();
?>
<html>
<head>
<title>Panel</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<?php
include "header.php";
$db = include("db/connect.php");
?>
<section class="content">
	<h1 class="icon" style="background-image: url('icon_reportes.png')">Reportes</h1>
	<form>
		<label for="desde">Desde</label>
		<input name="desde" type="date">
		<label for="hasta">Hasta</label>
		<input name="hasta" type="date">
		<input type="submit" class="busqueda" style="background-image: url('icon_busqueda.png')" value="" />
	</form>
<?php
include('datos_ciudadano.php');
?>
	<h2>Apoyos</h2>
<?php
if($existe && $_SESSION['rol'] < 3){
	echo "<a href='agregar_apoyo.php?id=" . $_GET['id'] . "'>Agregar</a>";
}
?>
	<table>
		<thead>
			<th>ID</th>
			<th>Ciudadano</th>
			<th>Fecha</th>
			<th>Descripcion</th>
			<th>Motivo</th>
			<th>PDF</th>
		</thead>
		<tbody>
<?php
if( isset($_GET["hasta"]) && $_GET['hasta'] != ""){
	$hasta = $_GET['hasta'];
}else{
	$hasta = date('Y-m-d');
}
if( isset($_GET['desde']) && $_GET['desde'] != ""){
	$desde = $_GET['desde'];
}else{
	$desde = date('0000-00-00');
}
$stm = $db->prepare("SELECT Apoyos.id, fecha, descripcion, motivo, CONCAT(Ciudadanos.nombre, ' ', Ciudadanos.ap_pat, ' ', Ciudadanos.ap_mat), Ciudadanos.id FROM Apoyos LEFT JOIN Ciudadanos ON ciudadano = Ciudadanos.id WHERE fecha <= ? AND fecha >= ?");
$stm->bind_param("ss", $hasta, $desde);
$stm->execute();
$stm->bind_result($id, $fecha, $descripcion, $motivo, $ciudadano, $ciud_id);

while($stm->fetch()){
	echo "<tr>";
	echo "<td>" . $id. "</td>";
	echo "<td><a href='perfil_ciudadano.php?id=" . $ciud_id . "'>" . $ciudadano . "</a></td>";
	echo "<td>" . $fecha . "</td>";
	echo "<td>" . $descripcion . "</td>";
	echo "<td>" . $motivo . "</td>";
	echo "<td><a href='topdf.php?id=" . $id . "'>PDF</a></td>";
	echo "</tr>";
}
?>
	</tbody>
	</table>
	<h2>Ordenes de compra</h2>
<?php
if($existe && $_SESSION['rol'] < 3){
	echo "<a href='orden_compra.php?id=" . $_GET['id'] . "'>Agregar</a>";
}
?>
	<table>
		<thead>
			<th>Numero de orden</th>
			<th>Ciudadano</th>
			<th>Fecha</th>
			<th>Proveedor</th>
			<th>Justificacion</th>
			<th>PDF</th>
		</thead>
		<tbody>
<?php
$stm = $db->prepare("SELECT id_orden, fecha, Proveedores.nombre, justificacion, CONCAT(Ciudadanos.nombre, ' ', Ciudadanos.ap_pat, ' ', Ciudadanos.ap_mat), Ciudadanos.id FROM orden_compra LEFT JOIN Proveedores ON proveedor = Proveedores.id LEFT JOIN Ciudadanos ON ciudadano = Ciudadanos.id WHERE fecha <= ? AND fecha >= ?");
$stm->bind_param("ss", $hasta, $desde);
$stm->execute();
$stm->bind_result($id, $fecha, $proveedor, $justificacion, $nombre, $ciud_id);

while($stm->fetch()){

	echo "<tr>";
	echo "<td>" . $id . "</td>";
	echo "<td><a href='perfil_ciudadano.php?id=" . $ciud_id . "'>" . $nombre . "</a></td>";
	echo "<td>" . $fecha . "</td>";
	echo "<td>" . $proveedor . "</td>";
	echo "<td>" . $justificacion . "</td>";
	echo "<td><a href='ord_compra_pdf.php?id=" . $id . "'>PDF</a></td>";
	echo "</tr>";

}
?>
			</tbody>
	</table>
	<h2>Vales de combustible</h2>
<?php
if($existe && $_SESSION['rol'] < 3){
	echo "<a href='vale_combustible.php?id=" . $_GET['id'] . "'>Agregar</a>";
}
?>
	<table>
		<thead>
			<th>Folio</th>
			<th>Fecha</th>
			<th>Ciudadano</th>
			<th>Proveedor</th>
			<th>Cantidad</th>
			<th>Tipo</th>
			<th>Justificacion</th>
			<th>PDF</th>
		</thead>
		<tbody>
<?php
$stm = $db->prepare("SELECT id_vale, fecha, Proveedores.nombre, justificacion, cantidad, tipo, CONCAT(Ciudadanos.nombre, ' ', Ciudadanos.ap_pat, ' ', Ciudadanos.ap_mat), Ciudadanos.id FROM vale_combustible LEFT JOIN Proveedores ON proveedor = Proveedores.id 
	LEFT JOIN Ciudadanos ON ciudadano = Ciudadanos.id
	WHERE fecha <= ? AND fecha >= ?");
$stm->bind_param("ss", $hasta, $desde);
$stm->execute();
$stm->bind_result($id, $fecha, $proveedor, $justificacion, $cantidad, $tipo, $ciudadano, $ciud_id);

while($stm->fetch()){
	echo "<tr>";
	echo "<td>" . $id . "</td>";
	echo "<td>" . $fecha . "</td>";
	echo "<td><a href='perfil_ciudadano.php?id=" . $ciud_id . "'>" . $ciudadano . "</a></td>";
	echo "<td>" . $proveedor . "</td>";
	echo "<td>" . $cantidad. "</td>";
	echo "<td>" . $tipo . "</td>";
	echo "<td>" . $justificacion . "</td>";
	echo "<td><a href='vale_combustible_pdf.php?id=" . $id . "'>PDF</a></td>";
	echo "</tr>";
}
?>
</tbody>
</table>
