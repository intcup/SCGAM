<?php
session_start();
?>
<html>
<head>
<title>Panel</title>
</head>
<body>
<header>
<?php
echo $_SESSION['user'];
?>
<div>
<a href="registrar.php">Registrar Ciudadano</a>
<a href="registros.php">Consultar Ciudadanos</a>
</div>
</header>
</body>
</html>
