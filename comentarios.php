

<?php
session_start();
#CONEXION MYSQL
$Conexion = mysqli_connect("localhost", "root", "")
    or die("FALLO EN LA CONEXION");
#SELECCIONAMOS BASE
mysqli_select_db($Conexion, "global")
    or die("ERROR EN LA SELECCION DE BASE");

$sql = "SELECT * FROM comentario";
$result = $Conexion->query($sql);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Figure BioSpa</title>
    <link rel="shortcut icon" href="imagenes/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    <section>
        <h1 style>Comentarios</h1>
        <div class="container">
            <table class="table table-dark table-striped" id="tablajson">
                <tr>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["comentario"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "<td>" . $row["usuario"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No HAY DATOS</td></tr>";
                }
                ?>
            </table>
            <?php
            if (isset($_SESSION['usuario'])) {
                echo
                '
                <button type="button" class="btn btn-dark btn-lg"><a href="comentario/agregar.php" style="text-decoration:none">Agregar Comentario</a></button>';
            }
            ?>
        </div>
    </section>
    <footer>
        <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>

    </footer>


</body>

</html>