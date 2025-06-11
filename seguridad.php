<?php
date_default_timezone_set("America/Mexico_City");
if(isset($_SESSION["usuario"]))
{
    $fechaGuardad=$_SESSION['Enter'];
    $ahora=date("Y-m-j H:i:s");
    $tiempo_transcurrido=(strtotime($ahora)-strtotime($fechaGuardad));
    if($tiempo_transcurrido >=60)
    {
        echo'Saliendo....';
        session_destroy();
        echo'<META HTTP-EQUIV="REFRESH" 
        CONTENT="0;URL=index.php">';
    }
    else
    {
        $_SESSION['Enter']=$ahora;
    }
}
?>