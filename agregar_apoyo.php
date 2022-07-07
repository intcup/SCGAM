<?php
session_start();
$db = require("db/connect.php");
if(!isset($_SESSION["user"])){
	header("Location: index.php");	
}

if(isset($_POST['env'])){
	$stm = $db->prepare("INSERT INTO Apoyos(descripcion,area,ciudadano,fecha, motivo) VALUES(?,?,?,DATE(NOW()),?)");
	$stm->bind_param("siss", $_POST['descripcion'], $_POST['area'], $_GET['id'], $_POST['motivo']);
	$stm->execute();
	header("Location: topdf.php?id=" . $stm->insert_id);
}
?>
<head>
<link rel="stylesheet" href="styles.css"/>
</head>
<html>
<?php
include "header.php";
?>
<p>
<form class="hor_form, content" method="post">
	<h1 class="icon" style="background-image: url('icon_agreg_ap.png')">Registrar Apoyo</h1>
				<p id="datos_c"></p>
<?php include('datos_ciudadano.php'); ?>
<label for="area">Area</label>
<select name="area" required>
<?php
	$areas = $db->prepare("SELECT id, nombre FROM Areas_Apoyos");
	$areas->execute();
	$areas->bind_result($id, $nombre);
	while ( $areas->fetch() ){
		echo "<option value=\"" . $id . "\">" . $nombre . "</option>";
	}
?>
</select>
<textarea name="descripcion" placeholder="Descripcion" required></textarea>
<textarea name="motivo" placeholder="Motivo" required></textarea>
<input id="enviar" name="env" type="submit" value="Enviar">
</form>
</html>
<script src="datos_ciudadano.js"></script>
