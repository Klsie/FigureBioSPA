<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Figure BioSpa</title>
    <link rel="shortcut icon" href="imagenes/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5eAwTMV3ELXQOR53NUpwuqZfWtUqB4d0&callback=inicializarMapa&libraries=places" async defer></script>
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
    <li class="menu-item"><a href="" class="menu-link">Inicio</a></li>
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
	<li class="menu-item"><a href="" class="menu-link">Inicio</a></li>
	<li class="menu-item"><a href="comentarios.php" class="menu-link">Comentarios</a></li>
    <li class="menu-item"><a href="productos.php" class="menu-link">Productos</a></li>
    <li class="menu-item"><a href="sucursales.php" class="menu-link">Sucursales</a></li>
	<li class="menu-item"><a href="carrito.php" class="menu-link">Carrito</a></li>
	<li class="menu-item"><a href="sesion/inicio.php" class="menu-link">Inicio de Sesión</a></li>
	<li class="menu-item"><a href="sesion/registro.php" class="menu-link">Registro</a></li>
</ul>';
            }
            ?>
        </div>
    </nav>

    <section>
        <div class="acercade">
            <h2>Quiénes Somos</h2>
            <p>En Figure BioSpa nuestra misión es ofrecer un refugio de bienestar donde nuestros clientes puedan escapar del estrés diario, rejuvenecer su cuerpo y mente, y descubrir una sensación renovada de equilibrio y armonía. Nos esforzamos por proporcionar experiencias indulgentes y terapéuticas, utilizando técnicas innovadoras y productos de alta calidad, para brindar un oasis de relajación que promueva la salud integral y el bienestar.</p>
        </div>
        <div id="mapa" style="height: 400px;"></div>
    </section>
    <footer>
        © 2024 Copyright:Figure BioSpa
        <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>

    </footer>

    <script>
        // Código JavaScript para inicializar el mapa y el marcador
        function inicializarMapa() {
            var coordenadas = {
                lat: 20.656612396240234,
                lng: -103.3006362915039
            };
            var mapa = new google.maps.Map(document.getElementById('mapa'), {
                center: coordenadas,
                zoom: 14
            });
            var marcador = new google.maps.Marker({
                position: coordenadas,
                map: mapa,
                title: 'Figure BioSpa'
            });
        }
    </script>

</body>

</html>