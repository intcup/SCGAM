<?php
session_start();
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');
?>
<section class="content">
<a href="vale_combustible.php">Agregar</a>
	<table>
<thead>
	<th>ID</th>	
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
$stm = $db->prepare('SELECT id_vale, fecha, proveedor, tipo, ciudadano, justificacion, cantidad FROM vale_combustible');
$stm->execute();
$stm->bind_result($id, $fecha, $prov, $tipo, $ciud, $just, $cant);
while($stm->fetch()){
	echo '<td>' . $id . '</td>';
	echo '<td>' . $fecha . '</td>';
	echo '<td>' . $prov . '</td>';
	echo '<td>' . $tipo . '</td>';
	echo '<td>' . $ciud . '</td>';
	echo '<td>' . $just. '</td>';
	echo '<td>' . $cant . '</td>';
	echo '<td><a href="vale_combustible_pdf.php?id=' . $cant . '">PDF</a></td>';
}
?>
	</table>
</section>
