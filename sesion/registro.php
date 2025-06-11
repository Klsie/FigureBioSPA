<?php
session_start();
?>
<!DOCTYPE html>
<html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Figure BioSpa</title>
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    <!--MI HOJA DE ESTILOS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="body">
    <div>
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-20">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card bg-dark text-white" style="border-radius: 15px;">
                            <div class="card-body p-5 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Formulario de Registro</h3>
                                <form action="registro.php" method="post">


                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="firstName" name="nombreUsuario" class="form-control form-control-lg" placeholder="Nombres" required />
                                                <label class="form-label" for="firstName">Nombres</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="email" id="emailAddress" name="correo" class="form-control form-control-lg" placeholder="Correo" required />
                                                <label class="form-label" for="emailAddress">Correo</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="tel" id="phoneNumber" name="celular" pattern="[0-9]{10}" class="form-control form-control-lg" placeholder="123-45-678" required />
                                                <label class="form-label" for="phoneNumber">Numero de Celular</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="password" id="password" name="passwordUsuario" class="form-control form-control-lg" placeholder="Contraseña" required />
                                                <label class="form-label" for="password">Constraseña</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-primary btn-lg" type="submit" value="Registrase" />
                                        <div>
                                            <div>
                                                <p class="mb-0">Regresar a Inicio <a href="../index.php" class="text-white-50 fw-bold">Inicio</a></p>
                                            </div>
                                            <div>
                                                <p class="mb-0">Tienes cuenta? <a href="inicio.php" class="text-white-50 fw-bold">Sesion</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <p>ERIC RODRIGO ARANA MARTINEZ 22310401 GLOBAL BD1 Y DW1</p>
    </footer>
</body>



<?php
if ($_POST) {
    $Nombre = $_POST['nombreUsuario'];
    $Correo =  $_POST['correo'];
    $Password = MD5($_POST['passwordUsuario']);
    $Telefono = $_POST['celular'];
    #Conectamos CON MYSQL
    $Conexion = mysqli_connect("localhost", "root", "") or die("FALLO EN LA CONEXION");
    #SELECCIONAMOS BASE
    mysqli_select_db($Conexion, "global") or die("ERROR EN LA SELECCION DE BASE");
    $Resultado = mysqli_query($Conexion, "INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `celUsuario`, `correoUsuari`, `pswUsuario`) 
      VALUES (null, '$Nombre', '$Telefono', '$Correo', '$Password');");
    if ($Resultado == true) {
        echo '("Bienvenido a nuestro sitio web';
        $_SESSION["usuario"] = "$Nombre";
        echo '<META HTTP-EQUIV = "REFRESH" CONTENT="1;URL=../index.php">';
    } else echo "ERROR EN CONSULTA";
    mysqli_close($Conexion);
}

?>


</html>