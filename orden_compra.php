<?php
session_start();
if(isset($_SESSION['user'])){
}
$db = include("db/connect.php");
if(isset($_POST["proveedor"])){
	$stm_ord = $db->prepare("INSERT INTO orden_compra(fecha,proveedor,ciudadano,justificacion) VALUES(DATE(NOW()),?,?,?)");
	$stm_ord->bind_param("sis", $_POST["proveedor"], $_POST["ciudadano"], $_POST["justificacion"]);
	$stm_ord->execute();
	$id_ord = $db->insert_id;
	$prod = explode(",", $_POST['productos']);
	$cant = explode(",", $_POST['cantidades']);
	$std_det = $db->prepare("INSERT INTO productos_orden(nombre, cantidad, id_orden) VALUES(?,?,$id_ord)");
	foreach($prod as $index => $des){
		$std_det->execute([$des, $cant[$index]]);
	}
}
?>
<link rel="stylesheet" href="styles.css"/>
<?php
include("header.php");
?>
<section class="content">
	<form id="orden">
		<input name="ciudadano"/>
		<input name="proveedor"/>
		<input name="justificacion"/>
		<input type="submit"/>
	</form>
	<form id="add_item">
		<input id="cant" type="number" step="1" value="1"/>
		<input id="producto"/>
		<input type="button" value="Agregar" onclick="add_item()"/>
	</form>
	<table>
		<tbody id="productos">
			<thead>
				<th>Cantidad</th>
				<th>Producto</th>
				<th>Borrar</th>
			</thead>
		</tbody>
	</table>
</section>
<script src="ord_compra.js"></script>
</body>
