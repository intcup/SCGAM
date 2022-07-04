<?php
session_start();
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');
$db=include('db/connect.php');
?>
<section class="content">
<?php
if(isset($_POST["ag_ar"])){
	$stm = $db->prepare("INSERT INTO Areas_Apoyos(nombre) VALUES(?)");
	$stm->bind_param("s", $_POST["nombre"]);
	$stm->execute();
}
?>

<h1>Areas</h1>
<form method="POST">
<label for="area">Area:</label>
<input type="text" name="nombre" id="area"/>
<br>
<input type="submit" name="ag_ar" value="Agregar"/>
</form>

<h1>Usuarios</h1>
<form method="POST">
	<label for="usuario">Usuario:</label>
	<input type="text" name="usuario"/>
	<br>
	<label for="password">Contraseña:</label>
	<input type="password" name="pass"/>
	<input type="submit" name="agr_usr" value="Agregar"/>
</form>
<?php
if(isset($_POST['agr_usr'])){
	$ins = $db->prepare("INSERT INTO Usuarios(nombre,pass) VALUES(?,?)");
	$hash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$user = $_POST['usuario'];
	$ins->bind_param("ss", $user, $hash);
	$ins->execute();
}
?>
</section>
