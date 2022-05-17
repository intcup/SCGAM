<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: index.php");
}
?>
<html>
<table>
<tr>

</tr>
<?php
$db = require("db/connect.php");
$stm = $db->prepare("SELECT * FROM Ciudadanos");
$stm->execute();
$res = $stm->get_result();
while($row = $res->fetch_assoc())
{
	echo "<tr>";

	echo "<td>" . $row['nombre'] . "</td>";
	echo "<td>" . $row['ap_pat'] . "</td>";
	echo "<td>" . $row['ap_mat'] . "</td>";
	echo "<td>" . $row['domicilio'] . "</td>";
	echo "<td>" . $row['telefono'] . "</td>";
	echo "<td><a href='perfil_ciudadano.php?id=" . $row['id'] . "'>link</a></td>";
	echo "</tr>";
}
?>
</table>
</html>
