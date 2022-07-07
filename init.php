<?php
$db = include("db/connect.php");

$count = $db->prepare("SELECT COUNT(id) FROM Usuarios");
$count->execute();
$count->bind_result($count);
$count->fetch();

if($count == 0){
	$ins = $db->prepare("INSERT INTO Usuarios(nombre,pass,rol) VALUES(?,?,1)");
	$hash = password_hash("admin", PASSWORD_BCRYPT);
	$user = "admin";
	$ins->bind_param("ss", $user, $hash);
	$ins->execute();
}

?>
