<header>
<span>
<?php
echo $_SESSION["user"];
?>
</span>
<span class="links">
<?php
if ($_SESSION['user'] = 'admin') {
	echo '<a href="admin_panel.php">Administrar</a>';
}
?>
<a href="panel.php">Inicio</a>
<a href="logout.php">Cerrar Sesion</a>
</span>
</header>
