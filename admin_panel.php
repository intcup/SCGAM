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
<form method="POST">
<label for="area">Area:</label>
<input type="text" name="nombre" id="area">
<input type="submit" name="ag_ar" value="Agregar">
</form>
</section>
