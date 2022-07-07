<?php
session_start();
if(isset($_POST['user'])){
	$db = require('db/connect.php');
	$stm = $db->prepare('SELECT nombre, pass, rol FROM Usuarios WHERE nombre=?');
	$stm->bind_param("s", $_POST['user']);
	$stm->execute();
	$stm->bind_result($nombre, $pass, $rol);
	if( $stm->fetch() ){
		if ( password_verify($_POST['pass'], $pass) ) {
			$_SESSION['user'] = $nombre;
			$_SESSION['rol'] = $rol;
		} else {
			$msg_err = "Contraseña incorrecta";
		}
	}else{
		$msg_err = "Usuario incorrecto";
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
<body style="text-align: center">
	<img src="escudo.png" height="100px" style="float: left; margin: 20px">
	<img src="logo_doc.png" style="float: right; margin: 20px" height="100px">
	<h1 style="font-size: 40px; margin-top: 20px">Presidencia Municipal De Gral. Zaragoza N.L.</h1>
<form method="POST" class="login">
	<img src="logo.png" height="100px">
	<h2>Sistema De Control y Gestion De Apoyos Municipales</h2>
<input type="text" name="user" placeholder="Usuario" class="nom login"/>
<br>
<input type="password" name="pass" placeholder="Contraseña" class="pass login"/>
<?php
if(isset($msg_err)){

	echo '<p>' . $msg_err . '</p>';

}
?>
<br>
<br>
<input type="submit" value="Iniciar" />
</form>
</body>
</html>
