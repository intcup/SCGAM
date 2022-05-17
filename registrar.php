<?php
session_start();
if(!isset($_SESSION['user'])){
	header("Location: index.php");	
	exit;
}else if(isset($_POST['nombre'])){
	$nombre = $_POST['nombre'];
	$ap_pat = $_POST['ap_pat'];
	$ap_mat = $_POST['ap_mat'];
	$domici = $_POST['domicilio'];
	$tel = $_POST['telefono'];

	error_log(json_encode($_FILES));

	// Guardar imagenes
	$cred_file = "imagenes/" . preg_replace('/\s+/', '_', $ap_pat . $ap_mat . $nombre);
	$extension = preg_replace("/.*\//", ".", $_FILES["cred_frente"]["type"]);
	$tempname_f = $_FILES["cred_frente"]["tmp_name"];
	$tempname_a = $_FILES["cred_atras"]["tmp_name"];
	
	$ruta_cred_f = $cred_file . "_f" . $extension;
	$ruta_cred_a = $cred_file . "_a" . $extension;
	move_uploaded_file($tempname_f, $ruta_cred_f);
	move_uploaded_file($tempname_a, $ruta_cred_a);

	// Registrar en la base de datos
	$db = require('db/connect.php');
	$stm = $db->prepare("INSERT INTO Ciudadanos(nombre,ap_pat,ap_mat,domicilio,telefono,ruta_credencial_frente,ruta_credencial_reverso) VALUES (?,?,?,?,?,?,?)");
	$stm->bind_param("sssssss", $nombre, $ap_pat, $ap_mat, $domici, $tel, $ruta_cred_f, $ruta_cred_a);
	$stm->execute();
	
}
?>
<html>
<head>
<title>Registrar</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<form method="POST" class="hor_form" enctype="multipart/form-data">
<input type="text" name="nombre"/>
<input type="text" name="ap_pat"/>
<input type="text" name="ap_mat"/>
<input type="text" name="domicilio"/>
<input type="tel" name="telefono"/>
<input type="file" name="cred_frente" capture="user" accept="image/*"/>
<input type="file" name="cred_atras" capture="user" accept="image/*"/>
<input type="submit"/>
</form>
</html>
