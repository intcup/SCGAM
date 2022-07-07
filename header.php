<header>
<img src="logo.png" style="height: 80px; position: absolute; left: 10px"></img>
<span class="user">
</span>
<span class="links">
<?php
if ($_SESSION['rol'] == 1){
	echo '<a href="admin_panel.php">Administrar</a>';
}
?>
<a href="reportes.php">Reportes</a>
<a href="panel.php">Inicio</a>
<a href="logout.php">Cerrar Sesion</a>
</span>
</span>
</header>
