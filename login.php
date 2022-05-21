<?php
session_start();
if(isset($_POST['user'])){
	$db = require('db/connect.php');
	$stm = $db->prepare('SELECT nombre FROM Usuarios WHERE nombre=?');
	$stm->bind_param("s", $_POST['user']);
	$stm->execute();
	$stm->bind_result($nombre);
	if( $stm->fetch() ){
		$_SESSION['user'] = $nombre;
		header("Location: panel.php");
	}
}
?>

<html>
<head>
<title>SCGAM</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<form method="POST" class="hor_form">
<input type="text" name="user" />
<input type="password" name="pass" />
<input type="submit" />
</form>
</body>
</html>
