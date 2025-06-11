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
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <form action="sesion.php" method="post">
                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">Inicio de Sesion</h2>
                                        <p class="text-white-50 mb-5">Bienvenido Administrador </p>
                                        <p class="text-white-50 mb-5">Por Favor Ingresa tu Datos </p>
                                        <div class="form-outline form-white mb-4">
                                            <input type="text" id="typeEmailX" name="usuario" class="form-control form-control-lg" placeholder="Usuario" />
                                            <label class="form-label" for="typeEmailX">Correo</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input type="password" id="typePasswordX" name="passwordUsuario" class="form-control form-control-lg" placeholder="Contraseña" />
                                            <label class="form-label" for="typePasswordX">Password</label>
                                        </div>

                                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Olvidaste tu password?</a></p>

                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Ingresar</button>

                                        <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                            <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                            <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                            <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                        </div>

                                    </div>
                                    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Lej_i8gAAAAAEno7O4SlAzGZljQyFubbzW3nPUw"></script>
                                    <script>
                                        grecaptcha.enterprise.ready(function() {
                                            grecaptcha.enterprise.execute('6Lej_i8gAAAAAEno7O4SlAzGZljQyFubbzW3nPUw', {
                                                action: 'login'
                                            }).then(function(token) {

                                            });
                                        });
                                    </script>
                                </form>
                                <div>
                                    <p class="mb-0">Regresar a Inicio <a href="../index.php" class="text-white-50 fw-bold">Inicio</a></p>
                                </div>

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

<?php
if ($_POST) {
    $Nombre = $_POST['usuario'];
    $Passw = MD5($_POST['passwordUsuario']);


    #CONEXION MYSQL
    $Conexion = mysqli_connect("localhost", "root", "")
        or die("FALLO EN LA CONEXION");
    #SELECCIONAMOS BASE
    mysqli_select_db($Conexion, "global")
        or die("ERROR EN LA SELECCION DE BASE");

    $Resultado = mysqli_query($Conexion, "SELECT * FROM `administrador`
     WHERE `userAdmin` = '$Nombre' AND `pswAdmin` = '$Passw'");
    if (mysqli_num_rows($Resultado)) {
        echo '<span>Bienvenido</span>';

        $_SESSION["usuario"] = "$Nombre";
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=inicio.php">';
    } else {
        echo "NO ACEPTADO";
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=../index.php">';
    }
}

?>
</body>
</html>