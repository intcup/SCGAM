<?php
session_start();
if(isset($_SESSION['user'])){
}
$db = include("db/connect.php");
if(isset($_POST["proveedor"])){
	$stm_ord = $db->prepare("INSERT INTO orden_compra(fecha,proveedor,ciudadano,justificacion) VALUES(DATE(NOW()),?,?,?)");
	$stm_ord->bind_param("iss", $_POST["proveedor"], $_GET["id"], $_POST["justificacion"]);
	$stm_ord->execute();
	$id_ord = $db->insert_id;
	$prod = explode(",", $_POST['productos']);
	$cant = explode(",", $_POST['cantidades']);
	$std_det = $db->prepare("INSERT INTO productos_orden(nombre, cantidad, id_orden) VALUES(?,?,$id_ord)");
	foreach($prod as $index => $des){
		$std_det->execute([$des, $cant[$index]]);
	}
	echo $stm_ord->insert_id;
	return 0;
}
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include("header.php");
?>
<section class="content">
	<h1>Agregar orden de compra</h1>
	<form id="orden">
<?php include('datos_ciudadano.php'); ?>
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
		<input name="justificacion" placeholder="Justificacion" required/>
		<input id="enviar" type="submit" value="Enviar" />
	</form>
	<form id="add_item">
		<input id="cant" type="number" step="1" value="1" placeholder="Cantidad"/>
		<input id="producto" placeholder="Producto"/>
		<input type="button" value="Agregar" onclick="add_item()"/>
	</form>
	<table>
			<thead>
				<th>Cantidad</th>
				<th>Producto</th>
				<th>Borrar</th>
			</thead>
		<tbody id="productos">
		</tbody>
	</table>
</section>
<script src="ord_compra.js"></script>
</body>
