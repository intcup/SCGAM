<?php
session_start();
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include('header.php');
include('admin_table.php');
$db=include('db/connect.php');
?>
<section class="content">

<h1 class="icon" style="background-image: url('icon_area.png');">Areas</h1>
<form method="POST">
<input type="text" name="nombre" id="area" placeholder="Area" required/>
<br>
<input type="submit" name="ag_ar" value="Agregar"/>
<?php
if(isset($_POST["ag_ar"])){
	$stm = $db->prepare("INSERT INTO Areas_Apoyos(nombre) VALUES(?)");
	$stm->bind_param("s", $_POST["nombre"]);
	try{
		$stm->execute();
		$mensaje = "Se ha registrado el area " . $_POST['nombre'];
	}catch(Exception $e){
		$mensaje = "No se ha podido registrar el area " . $_POST['nombre'];
	}
	echo "<p>" . $mensaje . "</p>";
	
}
?>
</form>
<?php
table("SELECT * FROM Areas_Apoyos");
?>

<h1 class="icon" style="background-image: url('user.png')">Usuarios</h1>
<form method="POST">
	<input type="text" name="usuario" placeholder="Usuario" required/>
	<br>
	<input type="password" name="pass" placeholder="Contraseña" required/>
	<br>
	<select name="rol">
		<option value="1">Administrar</option>
		<option value="2">Registrar</option>
		<option value="3">Reportes</option>
	</select>
	<br>
	<input type="submit" name="agr_usr" value="Agregar"/>
</form>
<?php
if(isset($_POST['agr_usr'])){
	$ins = $db->prepare("INSERT INTO Usuarios(nombre,pass,rol) VALUES(?,?,?)");
	$hash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$user = $_POST['usuario'];
	$rol = $_POST['rol'];
	$ins->bind_param("ssi", $user, $hash, $rol);
	try{
		$ins->execute();
		$mensaje = "Se ha registrado el usuario ";
	}catch(Exception $e){
		$mensaje = "No se ha registrado el usuario ";
	}
	echo "<p> " . $mensaje . $_POST['usuario'] . "</p>";
}
?>
<?php
table("SELECT * FROM Usuarios");
?>
<h1 class="icon" style="background-image: url('icon_proveedor.png')">Proveedores</h1>
<form method="POST">
	<input name='nombre' placeholder="Nombre" required/>
	<br>
	<input type="submit" name="agr_prov" value="Agregar"/>
</form>
<?php
if(isset($_POST["agr_prov"])){
	$stm = $db->prepare("INSERT INTO Proveedores(nombre) VALUES(?)");
	$stm->bind_param("s", $_POST["nombre"]);
	try{
		$stm->execute();
		$mensaje = "Se ha registrado el proveedor ";
	}catch(Exception $e){
		$mensaje = "No se ha registrado el proveedor ";
	}
	echo "<p>" . $mensaje . $_POST['nombre'] . "</p>";
}
table("SELECT * FROM Proveedores");
?>
</section>
