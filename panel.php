<?php
session_start();
?>
<html>
<head>
<title>Panel</title>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<header>
<?php
echo $_SESSION['user'];
?>
</header>
<div class="content">
<a href="registrar.php">Registrar Ciudadano</a>
<a href="registros.php">Consultar Ciudadanos</a>
</div>
</body>
</html>
