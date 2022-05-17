<?php
session_start();
if(!isset($_SESSION["user"])){
	header("Location: index.php");	
}

if(isset($_POST['id'])){
	$db = require("db/connect.php");
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
<option value="1">test</option>
</select>
<textarea name="descripcion"></textarea>
<input type="submit"/>
</form>
</html>
