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
	<h1 class="icon" style="background-image: url('icon_reportes.png')">Perfil Ciudadano</h1>
	<form>
		<label for="id">Id Ciudadano:</label>
		<input id="ciudadano" name="id" <?php
if(isset($_GET['id'])){
	echo "value='" . $_GET['id'] . "'";
}
?>/>
		<label for="desde">Desde</label>
		<input name="desde" type="date">
		<label for="hasta">Hasta</label>
		<input name="hasta" type="date">
		<input type="submit" class="busqueda" style="background-image: url('icon_busqueda.png')" value="" />
	</form>
<?php
include('datos_ciudadano.php');
echo '<img src="' . $ruta_cred . '" height="200px">';
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
if(isset($_GET['id'])){
	$stm = $db->prepare("SELECT id, fecha, descripcion, motivo FROM Apoyos WHERE ciudadano=? AND fecha <= ? AND fecha >= ?");
	$stm->bind_param("sss", $_GET['id'], $hasta, $desde);
	$stm->execute();
	$stm->bind_result($id, $fecha, $descripcion, $motivo);

	while($stm->fetch()){
		echo "<tr>";
		echo "<td>" . $id. "</td>";
		echo "<td>" . $fecha . "</td>";
		echo "<td>" . $descripcion . "</td>";
		echo "<td>" . $motivo . "</td>";
		echo "<td><a href='topdf.php?id=" . $id . "'>PDF</a></td>";
		echo "</tr>";
	}
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
			<th>Fecha</th>
			<th>Proveedor</th>
			<th>Justificacion</th>
			<th>PDF</th>
		</thead>
		<tbody>
<?php
if(isset($_GET['id'])){
	$stm = $db->prepare("SELECT id_orden, fecha, Proveedores.nombre, justificacion FROM orden_compra LEFT JOIN Proveedores ON proveedor = Proveedores.id WHERE ciudadano=? AND fecha <= ? AND fecha >= ?");
	$stm->bind_param("sss", $_GET['id'], $hasta, $desde);
	$stm->execute();
	$stm->bind_result($id, $fecha, $proveedor, $justificacion);

	while($stm->fetch()){

		echo "<tr>";
		echo "<td>" . $id . "</td>";
		echo "<td>" . $fecha . "</td>";
		echo "<td>" . $proveedor . "</td>";
		echo "<td>" . $justificacion . "</td>";
		echo "<td><a href='ord_compra_pdf.php?id=" . $id . "'>PDF</a></td>";
		echo "</tr>";

	}
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
			<th>Proveedor</th>
			<th>Cantidad</th>
			<th>Tipo</th>
			<th>Justificacion</th>
			<th>PDF</th>
		</thead>
		<tbody>
<?php
if(isset($_GET['id'])){
	$stm = $db->prepare("SELECT id_vale, fecha, Proveedores.nombre, justificacion, cantidad, tipo FROM vale_combustible LEFT JOIN Proveedores ON proveedor = Proveedores.id WHERE ciudadano=? AND fecha <= ? AND fecha >= ?");
	$stm->bind_param("iss", $_GET['id'], $hasta, $desde);
	$stm->execute();
	$stm->bind_result($id, $fecha, $proveedor, $justificacion, $cantidad, $tipo);

	while($stm->fetch()){

		echo "<tr>";
		echo "<td>" . $id . "</td>";
		echo "<td>" . $fecha . "</td>";
		echo "<td>" . $proveedor . "</td>";
		echo "<td>" . $cantidad. "</td>";
		echo "<td>" . $tipo . "</td>";
		echo "<td>" . $justificacion . "</td>";
		echo "<td><a href='vale_combustible_pdf.php?id=" . $id . "'>PDF</a></td>";
		echo "</tr>";

	}
}
?>
</tbody>
</table>
