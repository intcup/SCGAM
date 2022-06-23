<?php
session_start();
$db = require("db/connect.php");
if(!isset($_SESSION["user"])){
	header("Location: index.php");	
}

if(isset($_POST['id'])){
	$stm = $db->prepare("INSERT INTO Apoyos(descripcion,area,ciudadano,fecha, motivo) VALUES(?,?,?,SYSDATE(),?)");
	$stm->bind_param("siis", $_POST['descripcion'], $_POST['area'], $_POST['id'], $_POST['motivo']);
	$stm->execute();
	header("Location: perfil_ciudadano.php?id=" . $_POST['id']);
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
<input value=
"<?php
echo $_GET['id'];
?>"
type="hidden" name="id">
<label for="area">Area</label>
<select name="area">
<?php
	$areas = $db->prepare("SELECT id, nombre FROM Areas_Apoyos");
	$areas->execute();
	$areas->bind_result($id, $nombre);
	while ( $areas->fetch() ){
		echo "<option value=\"" . $id . "\">" . $nombre . "</option>";
	}
?>
</select>
<label for="descripcion">Descripcion</label>
<textarea name="descripcion"></textarea>
<textarea name="motivo"></textarea>
<input type="submit" value="Enviar">
</form>
</html>
