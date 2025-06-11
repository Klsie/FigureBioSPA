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
    <li class="menu-item"><a href="../index.php" class="menu-link">Inicio</a></li>
    <li class="menu-item"><a href="../comentarios.php" class="menu-link">Comentarios</a></li>
    <li class="menu-item"><a href="../productos.php" class="menu-link">Productos</a></li>
    <li class="menu-item"><a href="../sucursales.php" class="menu-link">Sucursales</a></li>
    <li class="menu-item"><a href="leer.php" class="menu-link">Carrito</a></li>
    <li class="menu-item"><a href="../cita.php" class="menu-link">Cita</a></li>
    <li class="menu-item"><a href="../citas.php" class="menu-link">Bienvenido '.$_SESSION["usuario"].'</a></li>
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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Modifica el Producto de tu Carrito</h3>
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
                        echo '<form action="modificar.php" method="post" name = "AgregarCarrito">';
                        echo '<input type="hidden" name="id" value="' . $row['idProducto'] . '">';
                        echo '<input type = "text" name="producto" value="' . $row['nombreProducto'] . '" readonly="readonly">';
                        /*echo '<br>';*/
                        echo ' $ <input type = "number" name="precio" size="3" value="' . $row['precioProducto'] . '" readonly="readonly"> MXN ';
                        echo '<br>';
                        echo ' Cantidad <input type = "number" name="cantidad" value="1" size="2" max="10" min="1">';
                        echo '<br>';
                        echo '<input name = "Modificar"  type="submit" id="btnAgregar" value="Modificar" style="style">';
                        echo '</div>';

                        echo '</form>';
                    }
                    mysqli_close($conexion);
                } else {
                    echo'VALIO';
                    //echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../index.php">';
                }

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
<?php
    if($_POST)
    {
        $id = $_POST['id'];
        $nombre = $_POST['producto'];
        $precio = $_POST['precio'];
        $newCantidad = $_POST['cantidad'];
        $subTotal = $precio * $newCantidad;

        /*key:value*/
        $criterio = "id"; //KEY

        //LEER EL ARCHIVO DEL JSON
        
        date_default_timezone_set('America/Mexico_City');
        $fechaHora = Date("F_j_Y");
        $NombreArchivo = $_SESSION['usuario'].$fechaHora."_pedido.json";
        $archivo = file_get_contents($NombreArchivo); 
        $productos =  json_decode($archivo); 

        //UN DATO DEL JSON
        $contador = 0;
        foreach ($productos as $producto) {
        if ($criterio == "id") {
            if ($producto->{'id'} == $id) {
                #CONEXION MYSQL
                $Conexion = mysqli_connect("localhost", "root", "")or die("FALLO EN LA CONEXION");
                #SELECCIONAMOS BASE
                mysqli_select_db($Conexion, "global")or die("ERROR EN LA SELECCION DE BASE");
                $Resultado = mysqli_query($Conexion, "SELECT * FROM `producto` WHERE `idProducto` = '$id'");
                if (mysqli_num_rows($Resultado)) {
                    $fila = mysqli_fetch_assoc($Resultado);
                    $cantidadDesdeBD = $fila['cantidadProducto']; 
                    
                    if($newCantidad>$producto->{'cantidad'}){
                        $cantidad = $cantidadDesdeBD-$newCantidad;
                        mysqli_query($Conexion,"UPDATE producto SET cantidadProducto = $cantidad WHERE idProducto = $id");
                    }else if($newCantidad<$producto->{'cantidad'}){
                        $cantidad = $cantidadDesdeBD+($producto->{'cantidad'}-$newCantidad);
                        mysqli_query($Conexion,"UPDATE producto SET cantidadProducto = $cantidad WHERE idProducto = $id");
                    }

                } else {
                    echo "NO ACEPTADO";
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=lol.php">';
                }
                break;
            }
        }
        $contador++;//CONTADOR PARA SABER EN QUE PARTE DEL ARREGLO ESTA EL OBJETO
    }

    //VALORES A MODIFICAR
    $productosprueba = json_decode($archivo,true);
    //MODIFICAMOS EL REGISTRO SELECCIONADO
    $productosprueba[$contador]['id']=$id;
    $productosprueba[$contador]['precio']=$precio;
    $productosprueba[$contador]['cantidad']=$newCantidad;
    $productosprueba[$contador]['subTotal']=$subTotal;

    //CREAMOS LA CADENA JSON
    $json_string= json_encode($productosprueba);
    //echo "<h2>Nueva Cadena de JSON</h2>";
    //echo $json_string;
    
    //GUARDAR DATOS EN ARCHIVO JSON
    file_put_contents($NombreArchivo,$json_string);
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=leer.php">';
        
    }
    
    ?>
    
