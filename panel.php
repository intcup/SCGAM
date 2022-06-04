<?php
session_start();
?>
<html>
<head>
<title>Panel</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<?php
include "header.php";
?>
<section class="content">
<a href="registrar.php">Registrar Ciudadano</a>
<a href="registros.php">Consultar Ciudadanos</a>
<a href="apoyos_fecha.php">Apoyos Registrados hoy</a>
<a href="apoyos_fecha.php?f=
<?php
echo date('Y-m-d', strtotime("-1 days"));
?>
">Apoyos Registrados ayer</a>
</section>
</body>
</html>
