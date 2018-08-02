<?php
include './conexio_bd/dades_conexio.php';
require_once 'Carro.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         $_SESSION["carro"]->finalitzarCompra($dsn,$user,$password,$_SESSION['id']);
         
         header('location:comandes_usuari.php');
         
        ?>
    </body>
</html>
