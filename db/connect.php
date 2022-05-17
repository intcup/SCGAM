<?php
$cred = file_get_contents(__DIR__ . "/credentials.json");
$datos = json_decode($cred, true);

$db = new mysqli("localhost", $datos['db_user'], $datos['db_pass'], 'SCGAM');

return $db;
?>
