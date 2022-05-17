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
<html>
<?php
echo "<div>" . $data["nombre"] . "</div>";
?>
<a href="
<?php 
echo "agregar_apoyo.php?id=" . $data['id'];
?>
">Agregar Apoyo</a>
<table>
<?php
$st_a = $db->prepare("SELECT * FROM Apoyos WHERE ciudadano=?");
$st_a->bind_param("i", $_GET['id']);
$st_a->execute();
$apoyos = $st_a->get_result();

error_log(json_encode($apoyos));

while ($apoyo = $apoyos->fetch_assoc()){
	echo $apoyo["descripcion"];
}

?>
</table>
</html>
