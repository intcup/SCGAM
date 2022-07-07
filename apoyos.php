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
<h1 class="icon" style="background-image: url('icon_apoyo.png')">Apoyos</h1>
	<form method="GET">
		<label for="desde">Desde:</label>
		<input name="desde" type="date"/>
		<label for="hasta">Hasta:</label>
		<input name="hasta" type="date"/>
		<input type="submit" class="busqueda" style="background-image: url('icon_busqueda.png')" value=""/>
	</form>
<table>
<thead>
	<th>Ciudadano</th>
	<th>Area</th>
	<th>Fecha</th>
	<th>Descripción</th>
	<th>PDF</th>
</thead>
<?php
$db = require("db/connect.php");
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
$stm = $db->prepare("SELECT CONCAT(Ciudadanos.nombre, ' ', ap_pat, ' ', ap_mat), Areas.nombre, fecha, descripcion, Apoyos.id
	FROM Apoyos
	LEFT JOIN Ciudadanos ON Apoyos.ciudadano = Ciudadanos.id 
	LEFT JOIN Areas_Apoyos as Areas ON Apoyos.area = Areas.id
	WHERE fecha <= ? AND fecha >= ?");
$stm->bind_param("ss", $hasta, $desde);
$stm->execute();
$stm->bind_result($nombre, $area, $fecha, $descripcion, $id);
while($stm->fetch()){
	echo "<tr>";
	echo "<td>" . $nombre . "</td>";
	echo "<td>" . $area . "</td>";
	echo "<td>" . $fecha . "</td>";
	echo "<td>" . $descripcion . "</td>";
	echo "<td><a href='topdf.php?id=" . $id . "'>PDF</a></td>";
	echo "</tr>";
}
?>
</table>
</section>
</body>
