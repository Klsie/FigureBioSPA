<?php
 session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhttml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Carrito Figure BioSpa</title>
</head>
<body class="body">
<header>
        <div class="logo">
            <img src="../imagenes/logo.jpg">
        </div>
    </header>

<div class="menu-container">
<?php /* BARRA DE MENU */
		if(isset($_SESSION['usuario'])){
            echo
            '<nav>
                <ul>
                    <div class="input-group">
                    <li class="menu-item"><a href="../index.php" class="menu-link">Inicio</a></li>
                    <li class="menu-item"><a href="../comentarios.php" class="menu-link">Comentarios</a></li>
                    <li class="menu-item"><a href="../productos.php" class="menu-link">Productos</a></li>
                    <li class="menu-item"><a href="../sucursales.php" class="menu-link">Sucursales</a></li>
                    <li class="menu-item"><a href="leer.php" class="menu-link">Carrito</a></li>
                    <li class="menu-item"><a href="../cita.php" class="menu-link">Cita</a></li>
                    <li class="menu-item"><a href="citas.php" class="menu-link">Bienvenido ' . $_SESSION["usuario"] . '</a></li>
                    <li class="menu-item"><a href="../sesion/cerrar.php" class="menu-link">Salir</a></li>
                    </div>	
                </ul>
            </nav>';
        }else{
        echo
    '<nav>
            <ul>
            <div class="input-group">
            <li class="menu-item"><a href="../index.php" class="menu-link">Inicio</a></li>
            <li class="menu-item"><a href="../comentarios.php" class="menu-link">Comentarios</a></li>
            <li class="menu-item"><a href="../productos.php" class="menu-link">Productos</a></li>
            <li class="menu-item"><a href="../sucursales.php" class="menu-link">Sucursales</a></li>
            <li class="menu-item"><a href="leer.php" class="menu-link">Carrito</a></li>
            <li class="menu-item"><a href="sesion/inicio.php" class="menu-link">Inicio de Sesión</a></li>
            <li class="menu-item"><a href="sesion/registro.php" class="menu-link">Registro</a></li>
                    </div>	
    </div>
            </ul>
        </nav>';
    }
	
?>
</div>
</header>
    <div class="body">
        <div class="div1">
                <div class="div2">
                    <section class="products-list">
                    <table class="table table-dark table-striped" id="tablajson">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>SubTotal</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </thead>
            <?php 
                date_default_timezone_set('America/Mexico_City');
                $fechaHora = Date("F_j_Y");
                $NombreArchivo = $_SESSION['usuario'].$fechaHora."_pedido.json";
                $Total = 0;
                $TotalF = 0;
                $IvaTotal = 0;
                if(file_exists($NombreArchivo))
                {
                    
                    $archivo = file_get_contents($NombreArchivo);
                    $productos = json_decode($archivo);

                    foreach ($productos as $producto)
                    {   
                        
                        echo '<tr><td><h3>'.$producto->{'id'}.'</h3></td>';
                        echo '<td><h3>$ '.$producto->{'nombre'}.'</h3></td>';
                        echo '<td><h3>$ '.$producto->{'precio'}.'</h3></td>';
                        echo '<td><h3>'.$producto->{'cantidad'}.'</h3></td>';
                        echo '<td><h3>$ '.$producto->{'subTotal'}.'</h3></td>';
                        echo '<td><h3><a href="modificar.php?id='.$producto->{'id'}.'"><img style="width: 40px; height: 40px;" src="https://proyectosinformaticatnl.ceti.mx/leamespa/Imagenes/modificar.png" alt=""></a></h3></td>';
                        echo '<td><h3><a href="eliminar.php?id='.$producto->{'id'}.'"><img style="width: 40px; height: 40px;"src="https://proyectosinformaticatnl.ceti.mx/leamespa/Imagenes/eliminar.png" alt=""></a></h3></td></tr>';
                        
                        $Total = $Total + $producto->{'subTotal'};
                        
                    }
                    $TotalF = $Total + $IvaTotal;
                }
                else
                {
                    echo "<script> alert ('Agrregue Productos a su Carrito'); window.location='../productos.php'</script>";
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../productos.php">';
                }
            ?>
        </table>
    </section>
        </div>
    <section id="Total">
        <?php
         if (file_exists($NombreArchivo)){
            echo '<center><table class="ctable table-dark table-sm">
            <thead>
                <th>Subtotal</th>
                <th>Total a pagar</th>
            </thead>';
            echo '<td><h3>$' . $Total . '</h3></td>';
            echo '<td><h3>$' . $TotalF . '</h3></td></tr>';
            echo '</table>';
            echo '<form action="generar.php" method="POST">
            <input type="hidden" name="total" value="'.$Total.'">
            <input type="hidden" name="totalfinal" value="'.$TotalF.'">
            <input type="submit" name="generar" value="Imprimir Factura" class="btn btn-dark">
        </form></center>';
        }
        ?>
    </section>
	

<footer>
                © 2024 Copyright:Figure BioSpa
                <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>
        
            </footer>

            </body>
</html>