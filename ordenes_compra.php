<?php
session_start();
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');
?>
<section class="content">
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
$stm = $db->prepare('SELECT id_orden, proveedor, ciudadano, justificacion, fecha FROM orden_compra');
$stm->execute();
$stm->bind_result($id,$prov,$ciud,$just, $fecha);
while($stm->fetch()){
	echo "<td>" . $id . "</td>";
	echo "<td>" . $ciud . "</td>";
	echo "<td>" . $prov . "</td>";
	echo "<td>" . $fecha . "</td>";
   	echo "<td>" . $just . "</td>";
	echo "<td><a href='ord_compra_pdf.php?id=$id'>PDF</a></td>";
}
?>
		</tbody>
	</table>
</section>
