<?php
session_start();
if(!isset($_SESSION['user'])){
	header("Location: index.php");
}
?>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include("header.php");
?>
<section class="content">
Apoyos del dia
<table>
<tr>
	<th>Ciudadano</th>
	<th>Area</th>
	<th>Fecha</th>
	<th>Descripción</th>
</tr>
<?php
// Crear variable de fecha
if (!isset($_GET['f'])){
	$fecha = date('Y-m-d');
} else {
	$fecha = $_GET['f'];
}
$db = require("db/connect.php");
$stm = $db->prepare("SELECT CONCAT(Ciudadanos.nombre, ' ', ap_pat, ' ', ap_mat), Areas.nombre, fecha, descripcion
	FROM Apoyos
	LEFT JOIN Ciudadanos ON Apoyos.ciudadano = Ciudadanos.id 
	LEFT JOIN Areas_Apoyos as Areas ON Apoyos.area = Areas.id
	WHERE DATE(fecha) = ?");
$stm->bind_param("s", $fecha);
$stm->execute();
$stm->bind_result($nombre, $area, $fecha, $descripcion);
while($stm->fetch()){
	echo "<tr>";
	echo "<td>" . $nombre . "</td>";
	echo "<td>" . $area . "</td>";
	echo "<td>" . $fecha . "</td>";
	echo "<td>" . $descripcion . "</td>";
	echo "</tr>";
}
?>
</table>
</section>
</body>
