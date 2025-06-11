<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhttml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../../estilos/estilos.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Figure BioSpa Administrador</title>
</head>'

<?php if (isset($_SESSION['usuario'])) {
    echo/*html*/ '
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
                    <li class="menu-item"><a href="../usuario/admin.php" class="menu-link">Usuarios</a></li>
                    <li class="menu-item"><a href="empleado/admin.php" class="menu-link">Empleado</a></li>
                    <li class="menu-item"><a href="../../sesion/cerrar.php" class="menu-link">Salir</a></li>
            </ul>
        </nav>
        </div>
        <div class="container-fluid">
       ';
    echo/*html*/ '  
                    <div>
                        <h2>MODULO GESTOR DEL ADMINISTRADOR</h2>
                    </div>';

    echo /*html*/ '
    <button type="button" class="btn btn-dark btn-lg"><a href="eliminar.php" style="text-decoration:none">Eliminar</a></button>
    <button type="button" class="btn btn-dark btn-lg"><a href="admin.php" style="text-decoration:none">Mostrar</a></button>
        <div class="container py-5 h-20">
                <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-7">
                            <div class="card bg-dark text-white" style="border-radius: 15px;">
                                <div class="card-body p-5 p-md-5">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">AGREGAR Empleado</h3>
                                        <div class="row">
                                        
                                        <div class="col-md-6 mb-4">
                                        
                                            <div class="form-outline">
                                            <form enctype="multipart/form-data" action="agregar.php" method="POST">
                                            <input type="text" id="Nombre" name="Nombre" class="form-control form-control-lg" placeholder="" required />
                                            <label class="form-label" for="Nombre">Nombre Empleado</label>
                                           
                                            </div>
    
                                        </div>
                                        <div class="col-md-6 mb-4">
    
                                            <div class="form-outline">
                                            <label class="form-label" for="user">Empleados </label>
                                            <input  type="submit" value="Enviar" name="Enviar"/>
                                            </form>
                                            </div>
    
                                        </div>
                                    </div>
    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                © 2024 Copyright:Figure BioSpa
                <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>
        
            </footer>';
} else {
    echo '<img  style="align-items: center;" src="Imagenes/404guy.png">';
}

?>

</div>
</body>

</html>

<?php
if ($_POST) {
    
        $Nombre = $_POST['Nombre'];
        #Conectamos CON MYSQL
        $Conexion = mysqli_connect("localhost", "root", "") or die("FALLO EN LA CONEXION");
        #SELECCIONAMOS BASE
        mysqli_select_db($Conexion, "global") or die("ERROR EN LA SELECCION DE BASE");

        $Resultado = mysqli_query($Conexion, "INSERT INTO `empleado` (`idEmpleado`,`nombreEmpleado`)
        VALUES (null,' " . $Nombre . "');");
        if ($Resultado == true) {
            echo "<script> alert ('INSERCION A BASE EXITOSA); window.location='agregar.php'</script>";
                        echo '<META HTTP-EQUIV = "REFRESH" CONTENT="1;URL=agregar.php">';
        } else
            echo "<script> alert ('ERROR EN LA INSERCION'); window.location='agregar.php'</script>";
        mysqli_close($Conexion);
    } 
    
?>