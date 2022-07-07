<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['rol'] > 2){
	header("Location: index.php");	
	exit;
}else if(isset($_POST['nombre'])){
	$nombre = $_POST['nombre'];
	$ap_pat = $_POST['ap_pat'];
	$ap_mat = $_POST['ap_mat'];
	$domici = $_POST['domicilio'];
	$tel = $_POST['telefono'];
	$id = $_POST['id'];

	// Guardar imagenes
	$cred_file = "imagenes/" . preg_replace('/\s+/', '_', $ap_pat . $ap_mat . $nombre);
	$extension_f = preg_replace("/.*\//", ".", $_FILES["cred_frente"]["type"]);
	$extension_a = preg_replace("/.*\//", ".", $_FILES["cred_atras"]["type"]);
	$tempname_f = $_FILES["cred_frente"]["tmp_name"];
	$tempname_a = $_FILES["cred_atras"]["tmp_name"];
	
	$ruta_cred_f = $cred_file . "_f" . $extension_f;
	$ruta_cred_a = $cred_file . "_a" . $extension_a;
	move_uploaded_file($tempname_f, $ruta_cred_f);
	move_uploaded_file($tempname_a, $ruta_cred_a);

	// Registrar en la base de datos
	$db = require('db/connect.php');
	$stm = $db->prepare("INSERT INTO Ciudadanos(id,nombre,ap_pat,ap_mat,domicilio,telefono,ruta_credencial_frente,ruta_credencial_reverso) VALUES (?,?,?,?,?,?,?,?)");
	$stm->bind_param("ssssssss", $id, $nombre, $ap_pat, $ap_mat, $domici, $tel, $ruta_cred_f, $ruta_cred_a);
	try{
		$stm->execute();
		header('Location: perfil_ciudadano.php?id=' . $stm->insert_id);
	}catch(Exception $e){
		$mensaje = "No se pudo registrar";
	}
}
?>
<html>
<head>
<title>Registrar</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<?php
include "header.php";
?>
<form method="POST" class="hor_form content" enctype="multipart/form-data">
	<h1 class="icon" style="background-image: url('icon_regciud.png')">Registrar ciudadano</h1>
<input type="text" name="id" placeholder="ID"
<?php if(isset($_GET['id'])){echo "value='" . $_GET['id'] . "'";} ?>
required/>
<input type="text" name="nombre" placeholder="Nombre" required/>
<input type="text" name="ap_pat" placeholder="Apellido Paterno" required/>
<input type="text" name="ap_mat" placeholder="Apellido Materno" required/>
<input type="text" name="domicilio" placeholder="Domicilio" required/>
<input type="tel" name="telefono" placeholder="Telefono" required/>
<label for="cred_atras">Credencial frente:</label>
<input type="file" name="cred_frente" capture="user" accept="image/*" required/>
<label for="cred_atras">Credencial reverso:</label>
<input type="file" name="cred_atras" capture="user" accept="image/*" required/>
<input type="submit" value="Guardar"/>
<?php
if(isset($mensaje)){
	echo "<p>" . $mensaje . "</p>";
}
?>
</form>
</html>
