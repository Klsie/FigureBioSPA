<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
if(isset($_GET['id'])) {
    $valor = $_GET['id'];

    date_default_timezone_set('America/Mexico_City');
    $fechaHora = Date("F_j_Y");
    $NombreArchivo = $_SESSION['usuario'] . $fechaHora . "_pedido.json";
    $archivo = file_get_contents($NombreArchivo);
    $productos = json_decode($archivo);

    $contador = 0;
    foreach ($productos as $producto) {
        if ($producto->{'id'} == $valor) {
            echo "<h1>Nombre producto: " . $producto->{'nombre'} . "</h1><br>";
            echo "<h2>Precio: " . $producto->{'precio'} . "</h2><br>";
            echo "<h2>Cantidad: " . $producto->{'cantidad'} . "</h2><br>";

            // Update quantity in the database
            $id = $producto->{'id'};
            $newQuantity = $producto->{'cantidad'};

            // Your database connection code goes here (replace placeholders with actual values)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "global";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update quantity in the database
            $updateQuery = "UPDATE producto SET cantidadProducto = cantidadProducto + $newQuantity WHERE idProducto = $id";

            if ($conn->query($updateQuery) === TRUE) {
                // Quantity updated in the database, proceed with updating the JSON file

                unset($productos[$contador]);
                $productos = array_values($productos);
                $json_string = json_encode($productos);

                file_put_contents($NombreArchivo, $json_string);

                if (!empty($productos)) {
                    /*echo "<h2>Nueva cadena JSON</h2>";
                    echo $json_string;*/
                    file_put_contents($NombreArchivo, $json_string);
                } else {
                    // Elimina el archivo
                    unlink($NombreArchivo);
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../productos.php">';
                    echo "<script> alert ('Carrito Vacio'); window.location='../productos.php'</script>";
                }

                $conn->close();
                break;
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        $contador++;
    }
}
echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=leer.php">';
?>

</body>
</html>