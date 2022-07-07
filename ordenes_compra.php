<?php
session_start();
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');
?>
<section class="content">
	<h1 class="icon" style="background-image: url('icon_orden.png')">Ordenes de compra</h1>
	<form method="GET">
		<label for="desde">Desde:</label>
		<input name="desde" type="date"/>
		<label for="hasta">Hasta:</label>
		<input name="hasta" type="date"/>
		<input type="submit" class="busqueda" style="background-image: url('icon_busqueda.png')" value="" />
	</form>
<a href="orden_compra.php">Agregar orden de compra</a>
	<table>
		<thead>
			<th>ID</th>
			<th>Ciudadano</th>
			<th>Proveedor</th>
			<th>Fecha</th>
			<th>Justificacion</th>
			<th>PDF</th>
		</thead>
		<tbody>
<?php
$db = include('db/connect.php');
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
$stm = $db->prepare('SELECT id_orden, proveedores.nombre, CONCAT(ciudadanos.nombre, " ", ciudadanos.ap_pat, " ", ciudadanos.ap_mat), justificacion, fecha FROM orden_compra LEFT JOIN Ciudadanos ON ciudadanos.id = ciudadano LEFT JOIN Proveedores ON proveedor = Proveedores.id WHERE fecha >= ? AND fecha <= ? ORDER BY fecha DESC');
$stm->bind_param("ss", $desde, $hasta);
$stm->execute();
$stm->bind_result($id,$prov,$ciud,$just, $fecha);
while($stm->fetch()){
	echo "<tr>";
	echo "<td>" . $id . "</td>";
	echo "<td>" . $ciud . "</td>";
	echo "<td>" . $prov . "</td>";
	echo "<td>" . $fecha . "</td>";
   	echo "<td>" . $just . "</td>";
	echo "<td><a href='ord_compra_pdf.php?id=$id'>PDF</a></td>";
	echo "</tr>";
}
?>
		</tbody>
	</table>
</section>
