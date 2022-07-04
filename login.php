<?php
session_start();
if(isset($_POST['user'])){
	$db = require('db/connect.php');
	$stm = $db->prepare('SELECT nombre, pass FROM Usuarios WHERE nombre=?');
	$stm->bind_param("s", $_POST['user']);
	$stm->execute();
	$stm->bind_result($nombre, $pass);
	if( $stm->fetch() ){
		if ( password_verify($_POST['pass'], $pass) ) {
			$_SESSION['user'] = $nombre;
			error_log($nombre);
		} else {
			
		}
	}
}

if(isset($_SESSION['user'])) {
	header("Location: panel.php");
}
?>

<html>
<head>
<title>SCGAM</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<form method="POST" class="hor_form content">
<label for="user">Usuario</label>
<input type="text" name="user" />
<label for="pass">Contraseña</label>
<input type="password" name="pass" />
<input type="submit" value="Iniciar" />
</form>
</body>
</html>
