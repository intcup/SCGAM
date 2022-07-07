<?php
session_start();
$db = require('connect.php');
if(!isset($_SESSION['user'])){
	header('Location: login.php');
}

function login($rol){
	if($rol > $_SESSION['rol']){
		header('Location: panel.php');
	}
}
