<?php
session_start();
if(!isset($_SESSION['user'])){
	header('Location: index.php');
}
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');

if(isset($_POST['proveedor'])){
	$db = include('db/connect.php');
	$stm = $db->prepare('INSERT INTO vale_combustible(fecha, proveedor, tipo, ciudadano, justificacion, cantidad) VALUES(DATE(NOW()), ?, ?, ?, ?, ?)');
	$stm->bind_param('ssssi', $_POST['proveedor'], $_POST['tipo'], $_POST['ciudadano'], $_POST['justificacion'], $_POST['cantidad']);
	$stm->execute();
}

?>
<section class="content">
	<form method="POST">
		<label>Proveedor</label>
		<br>
		<input name="proveedor"/>
		<br>
		<label>Tipo</label>
		<select name="tipo">
			<option>Gasolina</option>
			<option>Diesel</option>
			<option>Gas</option>
		</select>
		<br>
		<label>Tipo</label>
		<br>
		<input type="number" step="1"/>
		<br>
		<label>Ciudadano</label>
		<br>
		<input name="ciudadano"/>
		<br>
		<label>Justificacion</label>
		<br>
		<input name="justificacion"/>
		<br>
		<input value="Enviar" type="submit"/>
	</form>
</section>
