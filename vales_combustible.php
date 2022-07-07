<?php
session_start();
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');
?>
<section class="content">
	<h1 class="icon" style="background-image: url('icon_valecom.png')">Vales de combustible</h1>
	<form method="GET">
		<label for="desde">Desde:</label>
		<input name="desde" type="date"/>
		<label for="hasta">Hasta:</label>
		<input name="hasta" type="date"/>
		<input type="submit" class="busqueda" style="background-image: url('icon_busqueda.png')" value="" />
	</form>
<a href="vale_combustible.php">Agregar</a>
	<table>
<thead>
	<th>Folio</th>	
	<th>Fecha</th>	
	<th>Proveedor</th>	
<th>Tipo</th>
	<th>Ciudadano</th>
	<th>Justificacion</th>	
	<th>Cantidad</th>	
	<th>PDF</th>	
</thead>
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
$stm = $db->prepare('SELECT id_vale, fecha, Proveedores.nombre, tipo, CONCAT(ciudadanos.nombre, " ", ciudadanos.ap_pat, " ", ciudadanos.ap_pat), justificacion, cantidad FROM vale_combustible LEFT JOIN Proveedores ON proveedor = Proveedores.id LEFT JOIN Ciudadanos ON ciudadano = Ciudadanos.id WHERE fecha >= ? AND fecha <= ? ORDER BY fecha DESC');
$stm->bind_param("ss", $desde, $hasta);
$stm->execute();
$stm->bind_result($id, $fecha, $prov, $tipo, $ciud, $just, $cant);
while($stm->fetch()){
	echo '<tr>';
	echo '<td>' . $id . '</td>';
	echo '<td>' . $fecha . '</td>';
	echo '<td>' . $prov . '</td>';
	echo '<td>' . $tipo . '</td>';
	echo '<td>' . $ciud . '</td>';
	echo '<td>' . $just. '</td>';
	echo '<td>' . $cant . '</td>';
	echo '<td><a href="vale_combustible_pdf.php?id=' . $id . '">PDF</a></td>';
	echo '</tr>';
}
?>
	</table>
</section>
