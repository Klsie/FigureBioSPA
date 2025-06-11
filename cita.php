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
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    <!--MI HOJA DE ESTILOS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php if (isset($_SESSION['usuario'])) {
    echo /*hml*/ '<body class="body">
    <header>
        <div class="logo">
            <img src="imagenes/logo.jpg">
        </div>
    </header>

    <nav>
        <div class="menu-container">
            
    <ul class="menu-list">
    <li class="menu-item"><a href="index.php" class="menu-link">Inicio</a></li>
    <li class="menu-item"><a href="comentarios.php" class="menu-link">Comentarios</a></li>
    <li class="menu-item"><a href="productos.php" class="menu-link">Productos</a></li>
    <li class="menu-item"><a href="sucursales.php" class="menu-link">Sucursales</a></li>
    <li class="menu-item"><a href="carrito/leer.php" class="menu-link">Carrito</a></li>
    <li class="menu-item"><a href="cita.php" class="menu-link">Cita</a></li>
    <li class="menu-item"><a href="citas.php" class="menu-link">Bienvenido '.$_SESSION["usuario"].'</a></li>
    <li class="menu-item"><a href="sesion/cerrar.php" class="menu-link">Salir</a></li>
    </ul>
        </div>
    <div>
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-20">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card bg-dark text-white" style="border-radius: 15px;">
                            <div class="card-body p-5 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5" >Registra tu Cita</h3>
                                <form action="cita.php" method="post">


                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">

                                                <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control form-control-lg" value="' . $_SESSION["usuario"] . '"readonly="readonly" />
                                                <label class="form-label" for="nombreUsuario">Nombre</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="date" id="Fecha" name="Fecha" class="form-control form-control-lg" placeholder="" required />
                                                <label class="form-label" for="Fecha">Fecha</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="time" id="Hora" name="Hora"  class="form-control form-control-lg"  required />
                                                <label class="form-label" for="Hora">Hora</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                            <select class="form-select form-select-lg mb-3" name="Empleados" id="Empleados">
                                            ';
    $conexion = mysqli_connect("localhost", "root", "") or die("Error en la conexion de la base de datos ");
    mysqli_select_db($conexion, "global") or die("Error en la base de datos");
    $Resultado = mysqli_query($conexion, "SELECT * FROM `empleado`;");
    while ($row = mysqli_fetch_array($Resultado)) {
        echo '<option>' . $row['idEmpleado'] . ' | ' . $row['nombreEmpleado'] . '</option>';
    }

    echo '</select>
                                        <label class="form-label" for="Empleados">Atiende</label>


                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-primary btn-lg" type="submit" value="Agendar" onclick="validarHora()" />
                                        <div>
                                        </div>
                                    </div>
                                </form>

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
    </div>
    <script>
    function validarHora() {
      // Obtener el valor del campo de entrada de la hora
      var horaIngresada = document.getElementById("Hora").value;

      // Convertir la cadena de hora a un objeto de fecha para comparar
      var horaComparar = new Date("2024-02-11 " + horaIngresada);

      // Definir la hora límite (18:00)
      var horaLimite = new Date("2024-02-11  18:00");

      // Comparar la hora ingresada con la hora límite
      if (horaComparar > horaLimite) {
        alert("La hora no puede ser posterior a las 18:00 (6:00 PM).");
      } else {
        alert("Hora válida. Cita Registrada.");
        // Aquí puedes enviar el formulario si es necesario
        // document.getElementById("horaForm").submit();
      }
    }
    document.getElementById("horaForm").submit();
  </script>
</body>
</html>';
} ?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre = $_SESSION['usuario'];
    $Conexion = mysqli_connect("localhost", "root", "") or die("FALLO EN LA CONEXION");
    #SELECCIONAMOS BASE
    mysqli_select_db($Conexion, "global") or die("ERROR EN LA SELECCION DE BASE");
    # Obtener el idUsuario de la tabla usuario
    $queryUsuario = "SELECT celUsuario FROM usuario WHERE nombreUsuario = '$Nombre'";
    $resultadoUsuario = mysqli_query($Conexion, $queryUsuario);
    $Hora = $_POST['Hora'];
    $limiteHora = strtotime('18:00');
    $horaIngresada = strtotime($Hora);

    if ($horaIngresada <=$limiteHora) {
        if ($filaUsuario = mysqli_fetch_assoc($resultadoUsuario)) {
            $celUsuario = $filaUsuario['celUsuario'];
            $Fecha =  $_POST['Fecha'];
            
            $Empleado = $_POST['Empleados'];
            #Conectamos CON MYSQL
            $Resultado = mysqli_query($Conexion, "INSERT INTO `cita` (`idCita`, `fechaCita`, `horaCita`, `nombreUsuario`,`telUsuario`, `idEmpleado`) 
          VALUES (null, '$Fecha', '$Hora', '$Nombre','$celUsuario', '$Empleado');");
            if ($Resultado == true) {
                echo "<script> alert ('Cita Registrada con Exito); window.location='cita.php'</script>";
                echo '<META HTTP-EQUIV = "REFRESH" CONTENT="1;URL=cita.php">';
            } else {
                echo "<script> alert ('ERROR EN LA INSERCION'); window.location='cita.php'</script>";
            };
            mysqli_close($Conexion);
        }
    } else {
        echo "<script> alert ('ERROR HORA); window.location='cita.php'</script>";

}
}

?>