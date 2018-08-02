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
        <!--<meta http-equiv="content-type" content="text/html" charset="ISO-8859-15">-->
        <meta charset="UTF-8">
        
        <link rel="stylesheet" type="text/css" href="css/menuprincipal.css">
        <link rel="stylesheet" type="text/css" href="css/botigaOnline.css">
        <Link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        <link rel="shortcut icon" type="image/x-icon" href="imatges/favicon.ico" />
        
        <!--Aquest meta el fem servir perque detecti els dispositus mobils etc... -->
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
         <meta name="author" content="Salvador Rodríguez Vihé">
         <meta name="Keywords" content="">
         <meta name="Description" content="">
         <meta http-equiv="Content-Language" content="es">
         <meta name="distribution" content="global">
         <meta name="Robots" content="all">
         
         <meta name="Title" content="VolemWeb">
        
        <script type="text/javascript" src="java/jquery-1.2.3.js"></script>
        <script type="text/javascript" src="java/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="java/Jquery.js"></script>
        <!--Perque funcioni el shadow box important qe hi haguin els 2 arxius .js i .css -->
        <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <Link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        
        <script type="text/javascript" src="java/menu.js"></script>
        
        <title>Carro</title>
    </head>
    <body>
        <nav>
            <?php include 'menuprincipal.php';?>
        </nav>
        
        <div id="contingut">
            <?php
            if(!empty($_SESSION['carro']))
            {
                echo '</br></br>';
                $_SESSION["carro"]->__toString();
                echo '</br></br>';
                
                $numProductes=$_SESSION['carro']->getNumProductes();
                
                if($numProductes>0)
                {
             ?>
             <div align=center><a href="finalitzar_Compra.php">[Finalitzar Compra]</a></div>
            <?php
                }
            } 
            else
            {
                 header('Location:entrar_botiga.php');
            }
            ?>
        </div>
        
           <footer>
            <section>
                <?php include 'peupagina.php';?>
            </section>
        </footer>
    </body>
</html>
