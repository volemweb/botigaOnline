<?php
include './conexio_bd/dades_conexio.php';
require_once 'Carro.php';
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_GET['producte']))
        {
          
              $_SESSION['carro']->eliminarProducte($_GET['producte']);
              header("location:pagina_carro.php");
              
        }
        else {header("location:pagina_carro.php");}
        ?>
    </body>
</html>
