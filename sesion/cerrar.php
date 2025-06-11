<?php
session_start();
session_destroy();
echo"Saliendo\n";
echo'<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../index.php">';
?>