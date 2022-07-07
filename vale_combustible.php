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
	$stm->bind_param('isssi', $_POST['proveedor'], $_POST['tipo'], $_GET['id'], $_POST['justificacion'], $_POST['cantidad']);
	try{
		$stm->execute();
		header("Location: vale_combustible_pdf.php?id=" . $stm->insert_id);
	}catch (Exception $e){
	
	}
}

?>
<section class="content">
	<h1>Agregar Vale de Combustible</h1>
<?php include('datos_ciudadano.php'); ?>
<form method="POST">
		<label>Proveedor</label>
				<select name="proveedor" required>
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
		<select name="tipo" required>
			<option>Gasolina</option>
			<option>Diesel</option>
			<option>Gas</option>
		</select>
				<input name="cantidad" type="number" step="1" required/>
			<br>
			<input name="justificacion" placeholder="Justificacion" required/>
			<input id="enviar" value="Enviar" type="submit"/>
</form>
</section>

<script src="datos_ciudadano.js"></script>
