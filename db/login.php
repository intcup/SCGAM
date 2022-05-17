<?php
$db = require('connect.php');
if(isset($_POST["user"])){
	error_log(json_encode($_POST));
}
