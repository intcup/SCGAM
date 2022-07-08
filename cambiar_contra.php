<?php
include('db/login.php');
login(1);
?>
<link rel="stylesheet" href="styles.css">
<?php
include('header.php');

if(isset($_POST['usuario'])){
	$stm = $db->prepare("UPDATE Usuarios SET pass=? WHERE nombre=?");
	$hash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$stm->bind_param("ss", $hash, $_POST['usuario']);
	$stm->execute();
}

?>
<section class="content">
<form method="POST">
<input name="usuario" required>
<input name="pass" type="password" required>
<input type="submit">
</form>
</section>
