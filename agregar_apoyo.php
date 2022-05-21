<?php
session_start();
$db = require("db/connect.php");
if(!isset($_SESSION["user"])){
	header("Location: index.php");	
}

if(isset($_POST['id'])){
	$stm = $db->prepare("INSERT INTO Apoyos(descripcion,area,ciudadano) VALUES(?,?,?)");
	$stm->bind_param("sii", $_POST['descripcion'], $_POST['area'], $_POST['id']);
	$stm->execute();
}
?>

<html>
<p>
<form method="post">
<input value=
"<?php
echo $_GET['id'];
?>"
type="hidden" name="id">
<select name="area">
<?php
	$areas = $db->prepare("SELECT id, nombre FROM Areas_Apoyos");
	$areas->execute();
	$areas->bind_result($id, $nombre);
	while ( $areas->fetch() ){
		echo "<option value=\"" . $id . "\">" . $nombre . "</option>";
	}
?>
</select>
<textarea name="descripcion"></textarea>
<input type="submit"/>
</form>
</html>
