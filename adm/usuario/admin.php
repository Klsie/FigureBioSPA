<?php
session_start();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD HTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhttml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../../estilos/estilos.css">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Figure BioSpa Administrador</title>
</head>

<?php if (isset($_SESSION['usuario'])) {
    echo '
<header>
    <div class="logo">
        <img src="../../imagenes/logo.jpg">
    </div>
</header>
<body class="body">
        <div class="menu-container">     
                    
                    <nav>
                    <ul class="menu-list">
                    <li class="menu-item"><a href="../inicio.php" class="menu-link">Inicio Admin</a></li>
                    <li class="menu-item"><a href="../comentario/admin.php" class="menu-link">Comentarios</a></li>
                    <li class="menu-item"><a href="../producto/admin.php" class="menu-link">Productos</a></li>
                    <li class="menu-item"><a href="../sucursal/admin.php" class="menu-link">Sucursal</a></li>
                    <li class="menu-item"><a href="../cita/admin.php" class="menu-link">Citas</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">Bienvenido ' . $_SESSION["usuario"] . '</a></li>
                    <li class="menu-item"><a href="admin.php" class="menu-link">Usuarios</a></li>
                    <li class="menu-item"><a href="../empleado/admin.php" class="menu-link">Empleado</a></li>
                    <li class="menu-item"><a href="../../sesion/cerrar.php" class="menu-link">Salir</a></li>
                </ul>
                    </nav>
                    </div>
                    <div class="container-fluid">';
    echo '  
                    <div>
                        <h2>MODULO GESTOR DEL ADMINISTRADOR</h2>
                    </div>';

    echo '
<button type="button" class="btn btn-dark btn-lg"><a href="eliminar.php" style="text-decoration:none">Eliminar</a></button>

                    <div class="container py-5 h-20">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card bg-dark text-white" style="border-radius: 15px;">
                                <div class="card-body p-5 p-md-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Usuarios Registrados</h3>
                                    <table class="table table-dark table-striped" id="tablajson">
                                    <thead>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        
                                    </thead>'; ?>
<?php
    $conexion = mysqli_connect("localhost", "root", "") or die("No se logro conectar con la base de datos");
    mysqli_select_db($conexion, "global");
    $Resultado = mysqli_query($conexion, "SELECT * FROM `usuario` WHERE `idUsuario`>=0;");
    while ($row = mysqli_fetch_array($Resultado)) {
        echo '<tr><td><h5>' . $row['idUsuario'] . '</h5></td>';
        echo '<td><h5>' . $row['nombreUsuario'] . '</h5></td>';
        echo '<td><h5>' . $row['celUsuario'] . '</h5></td>';
        echo '<td><h5>' . $row['correoUsuari'] . '</h5></td>';
        echo '</form>';
    }
    mysqli_close($conexion); ?>

<?php echo '</table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container py-5 h-100">
               
                <footer>
                © 2024 Copyright:Figure BioSpa
                <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>
        
            </footer>';
} else {
    echo '<img  style="align-items: center;" src="../imagenes/404guy.png">';
}

?>
</div>
</body>
</html>
