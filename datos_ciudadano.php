<?php
if(isset($_SESSION['user'])){
	$db = include('db/connect.php');
	$stm = $db->prepare("SELECT id, nombre, ap_pat, ap_mat, domicilio, telefono, ruta_credencial_frente FROM Ciudadanos WHERE id=?");
	$stm->bind_param('s', $_GET['id']);
	$stm->execute();
	$stm->bind_result($id, $nom, $appat, $apmat, $domicilio, $tel, $ruta_cred);
	if($stm->fetch()){
		echo '<p>';
		echo $nom . ' ' . $appat . ' ' . $apmat;
		echo '<br>';
		echo $domicilio;
		echo '</p>';
		$existe = true;
	} else {
		$existe = false;
	}
	$stm->close();
}
