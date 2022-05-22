<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: index.php");
}
?>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<html>
<div class="content">
	<table>
		<tr>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
			<th>Domicilio</th>
			<th>Telefono</th>
			<th>Enlace</th>
		<tr>
	<?php
	$db = require("db/connect.php");
	$stm = $db->prepare("SELECT * FROM Ciudadanos");
	$stm->execute();
	$res = $stm->get_result();
	while($row = $res->fetch_assoc())
	{
		echo "<tr>";
		echo "<td>" . $row['nombre'] . "</td>";
		echo "<td>" . $row['ap_pat'] . "</td>";
		echo "<td>" . $row['ap_mat'] . "</td>";
		echo "<td>" . $row['domicilio'] . "</td>";
		echo "<td>" . $row['telefono'] . "</td>";
		echo "<td><a href='perfil_ciudadano.php?id=" . $row['id'] . "'>perfil</a></td>";
		echo "</tr>";
	}
	?>
	</table>
</div>
</html>
