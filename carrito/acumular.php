<?php
session_start();

if (isset($_POST)) {
    $id = $_POST['id'];
    $nombre = $_POST['producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $subTotal = $precio * $cantidad;

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

    // Retrieve current quantity from the database
    $selectQuery = "SELECT cantidadProducto FROM producto WHERE idProducto = $id";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentQuantity = $row['cantidadProducto'];

        // Check if there's enough quantity to deduct
        if ($currentQuantity >= $cantidad) {
            // Deduct quantity from the database
            $newQuantity = $currentQuantity - $cantidad;
            $updateQuery = "UPDATE producto SET cantidadProducto = $newQuantity WHERE idProducto = $id";

            if ($conn->query($updateQuery) === TRUE) {
                // Database update successful, now update your JSON file

                $pedido = array();
                date_default_timezone_set('America/Mexico_City');
                $fechaHora = Date("F_j_Y");
                $ruta = $_SESSION['usuario'] . $fechaHora . "_pedido.json";

                if (file_exists($ruta)) {
                    // Read JSON
                    $archivo = file_get_contents($ruta);
                    $pedido = json_decode($archivo, true);

                    $pedido[] = array('id' => $id, 'nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad, 'subTotal' => $subTotal);
                    // Create JSON string
                    $json_string = json_encode($pedido);
                    // Save data to JSON
                    $file = $ruta;
                    file_put_contents($file, $json_string);
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT=".5;URL=leer.php">';
                } else {
                    $pedido[] = array('id' => $id, 'nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad, 'subTotal' => $subTotal);
                    // Create JSON string
                    $json_string = json_encode($pedido);
                    // Save data to JSON
                    $file = $ruta;
                    file_put_contents($file, $json_string);
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT=".5;URL=leer.php">';
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Not enough quantity available in the database.";
        }
    } else {
        echo "Product with ID $id not found in the database.";
    }

    $conn->close();
}
?>