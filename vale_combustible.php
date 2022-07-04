<?php
session_start();
if(!isset($_SESSION['user'])){
	header('Location: index.php');
}
$db = include('db/connect.php');
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');

if(isset($_POST['proveedor'])){
	$db = include('db/connect.php');
	$stm = $db->prepare('INSERT INTO vale_combustible(fecha, proveedor, tipo, ciudadano, justificacion, cantidad) VALUES(DATE(NOW()), ?, ?, ?, ?, ?)');
	$stm->bind_param('isssi', $_POST['proveedor'], $_POST['tipo'], $_POST['ciudadano'], $_POST['justificacion'], $_POST['cantidad']);
	$stm->execute();
}

?>
<section class="content">
	<form method="POST">
		<label>Proveedor</label>
				<select name="proveedor">
<?php
$prov = $db->prepare('SELECT nombre, id FROM Proveedores');
$prov->execute();
$prov->bind_result($nom, $id);
while($prov->fetch()){
	echo '<option value="' . $id . '">' . $nom . '</option>';
}
?>
		</select>
		<label>Tipo</label>
		<select name="tipo">
			<option>Gasolina</option>
			<option>Diesel</option>
			<option>Gas</option>
		</select>
				<label>Cantidad</label>
				<input name="cantidad" type="number" step="1"/>
				<label>Ciudadano</label>
				<input name="ciudadano"/>
				<label>Justificacion</label>
				<input name="justificacion"/>
				<input value="Enviar" type="submit"/>
	</form>
</section>
