<?php
session_start();
$db = require('db/connect.php');
$stm = $db->query('CALL login("' . $_POST['user'] . '","' . $_POST['pass'] . '")');
$res = $stm->fetch_assoc();
if($res || isset($_SESSION['user'])){
	$_SESSION['user'] = $_POST['user'];
	header("Location: panel.php");
}
?>

<html>
<head>
<title>SCGAM</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<form method="POST" class="hor_form">
<input type="text" name="user" />
<input type="password" name="pass" />
<input type="submit" />
</form>
</body>
</html>
