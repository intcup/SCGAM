<?php
session_start();
if(!isset($_SESSION['user'])){
	header("Location: index.php");
}
$db = include("db/connect.php");
$stm = $db->prepare("SELECT * FROM Ciudadanos WHERE id=?");
$stm->bind_param("s", $_GET['id']);
$stm->execute();
$data = $stm->get_result()->fetch_assoc();
if($data){
	// $apoyos = $db->prepare("SELECT * FROM Apoyos WHERE ");
}else{
	header("Location: registros.php");
}
?>
<head>
<link rel="stylesheet" href="styles.css"/>
</head>
<html>
<?php
include "header.php";
?>
<div class="content">
<a href="
<?php 
echo "agregar_apoyo.php?id=" . $data['id'];
?>
">Agregar Apoyo</a>
<table>
<tr>
	<th>Descripcion</th>
	<th>Area</th>
</tr>
<?php
$st_a = $db->prepare("SELECT descripcion, area.nombre  FROM Apoyos inner join Areas_Apoyos as area ON area.id = Apoyos.area WHERE ciudadano=?");
$st_a->bind_param("i", $_GET['id']);
$st_a->execute();
$st_a->bind_result($desc, $area);

error_log(json_encode($apoyos));

while ($st_a->fetch()){
	echo "<tr>";
	echo "<td>" . $desc . "</td>";
	echo "<td>" . $area . "</td>";
	echo "</tr>";
}

?>
</table>
</div>
</html>
