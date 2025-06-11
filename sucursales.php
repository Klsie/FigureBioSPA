<?php
session_start();
?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Figure BioSpa</title>
	<link rel="shortcut icon" href="imagenes/logo.jpg" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="body">
	<header>
		<div class="logo">
			<img src="imagenes/logo.jpg">
		</div>
	</header>
	<nav>
		<div class="menu-container">
			<?php /* BARRA DE MENU */
			if (isset($_SESSION['usuario'])) {
				echo
				'
    <ul class="menu-list">
    <li class="menu-item"><a href="index.php" class="menu-link">Inicio</a></li>
    <li class="menu-item"><a href="comentarios.php" class="menu-link">Comentarios</a></li>
    <li class="menu-item"><a href="productos.php" class="menu-link">Productos</a></li>
    <li class="menu-item"><a href="sucursales.php" class="menu-link">Sucursales</a></li>
    <li class="menu-item"><a href="carrito/leer.php" class="menu-link">Carrito</a></li>
    <li class="menu-item"><a href="cita.php" class="menu-link">Cita</a></li>
    <li class="menu-item"><a href="citas.php" class="menu-link">Bienvenido '.$_SESSION["usuario"].'</a></li>
    <li class="menu-item"><a href="sesion/cerrar.php" class="menu-link">Salir</a></li>
    </ul>';
			} else {
				echo
				' <ul class="menu-list">
	<li class="menu-item"><a href="index.php" class="menu-link">Inicio</a></li>
	<li class="menu-item"><a href="comentarios.php" class="menu-link">Comentarios</a></li>
    <li class="menu-item"><a href="productos.php" class="menu-link">Productos</a></li>
    <li class="menu-item"><a href="sucursales.php" class="menu-link">Sucursales</a></li>
    <li class="menu-item"><a href="carrito/leer.php" class="menu-link">Carrito</a></li>
	<li class="menu-item"><a href="sesion/inicio.php" class="menu-link">Inicio de Sesión</a></li>
	<li class="menu-item"><a href="sesion/registro.php" class="menu-link">Registro</a></li>
</ul>';
			}
			?>
		</div>
	</nav>

	<div class="wrap">
		<div class="container">
			<?php
			if (isset($_SESSION['usuario'])) {
				echo '<h1 style="text-align="center">HOLA ' . $_SESSION['usuario'] . ' Recuerda siempre ver nuestras Redes Sociales</h1>';
			} else {
				echo '<h2>Hola Usuario Recuerda Iniciar Sesion Para Poder Agendar</h2>';
			}
			?>
			<section class="products-list">
				<?php
				#CONEXION CON MYSQL
				$conexion = mysqli_connect("localhost", "root", "") or die("No se logro conectar con la base de datos");
				#SELECCION BASE DE DATOS
				mysqli_select_db($conexion, "global");
				#Lectura de Productos
				$Resultado = mysqli_query($conexion, "SELECT * FROM `sucursal` WHERE `idSucursal`>0;");
				while ($row = mysqli_fetch_array($Resultado)) {
					if (isset($_SESSION['usuario'])) {
						echo '<div class="product-item">';
						echo '<img src = "imagenes/sucursales/' . $row['imagenSucursal'] . '"';
						echo '<a>' . $row['domicilio'] . '</a>';
						echo '<br>';
						echo '<a>  ' . $row['horarioSucursal'] . ' </a>';
						echo '</div>';
					} else {
						echo '<div class="product-item">';
						echo '<img src = "imagenes/sucursales/' . $row['imagenSucursal'] . '"';
						echo '<a>' . $row['domicilio'] . '</a>';
						echo '<br>';
						echo '<a>  ' . $row['horarioSucursal'] . '  </a>';
						echo '</div>';
					}
				}
				?>

			</section>

		</div>
	</div>
	<footer>
		© 2024 Copyright:Figure BioSpa
		<p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>

	</footer>

</body>

</html>