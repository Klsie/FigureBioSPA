<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Figure BioSpa</title>
    <link rel="shortcut icon" href="../imagenes/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5eAwTMV3ELXQOR53NUpwuqZfWtUqB4d0&callback=inicializarMapa&libraries=places" async defer></script>
</head>

<body class="body">
    <header>
        <div class="logo">
            <img src="../imagenes/logo.jpg">
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
    <li class="menu-item"><a href="../comentarios.php" class="menu-link">Comentarios</a></li>
    <li class="menu-item"><a href="../productos.php" class="menu-link">Productos</a></li>
    <li class="menu-item"><a href="../sucursales.php" class="menu-link">Sucursales</a></li>
    <li class="menu-item"><a href="leer.php" class="menu-link">Carrito</a></li>
    <li class="menu-item"><a href="../cita.php" class="menu-link">Cita</a></li>
    <li class="menu-item"><a href="../citas" class="menu-link">Bienvenido ' . $_SESSION["usuario"] . '</a></li>
    <li class="menu-item"><a href="../sesion/cerrar.php" class="menu-link">Salir</a></li>
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
    <section class="contenedor">
        <div class="container py-5 h-20">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card bg-dark text-white" style="border-radius: 15px;">
                        <div class="card-body p-5 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Agregar el Producto a tu Carrito</h3>
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                #CONEXION CON MYSQL
                                //$conexion = mysqli_connect("localhost", "root", "") or die("No se logro conectar con la base de datos");
                                $conexion = mysqli_connect("localhost", "root", "") or die("No se logro conectar con la base de datos");
                                #SELECCION BASE DE DATOS
                                mysqli_select_db($conexion, "global");
                                #Lectura de productos
                                $Resultado = mysqli_query($conexion, "SELECT * FROM `producto` WHERE `idProducto`='" . $id . "';");
                                while ($row = mysqli_fetch_array($Resultado)) {
                                    echo '<div>';
                                    echo '<img src = "../imagenes/' . $row['imagenProducto'] . '" class="imagen" >';
                                    echo '<form action="acumular.php" method="post" name = "AgregarCarrito">';
                                    echo '<input type="hidden" name="id" value="' . $row['idProducto'] . '">';
                                    echo '<input type = "text" name="producto" value="' . $row['nombreProducto'] . '" readonly="readonly">';
                                    /*echo '<br>';*/
                                    echo ' $ <input type = "number" name="precio" size="3" value="' . $row['precioProducto'] . '" readonly="readonly"> MXN ';
                                    echo '<br>';
                                    echo ' Cantidad <input type = "number" name="cantidad" value="1" size="2" max="10" min="1">';
                                    echo '<br>';
                                    echo '<input name = "Agregar"  type="submit" id="btnAgregar" value="Agregar" style="style">';
                                    echo '</div>';

                                    echo '</form>';
                                }
                            } else {
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../index.php">';
                            }
                            mysqli_close($conexion);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        © 2024 Copyright:Figure BioSpa
        <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>

    </footer>
</body>

</html>