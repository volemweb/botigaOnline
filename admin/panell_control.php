<?php
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
        
        <link rel="stylesheet" type="text/css" href="../css/menuprincipal.css">
        <link rel="stylesheet" type="text/css" href="../css/botigaOnline.css">
        <link rel="stylesheet" type="text/css" href="css/menuAdmin.css">
        <link rel="stylesheet" type="text/css" href="css/Admin.css">
        <link rel="shortcut icon" type="image/x-icon" href="../imatges/favicon.ico" />
        
        <!--Aquest meta el fem servir perque detecti els dispositus mobils etc... -->
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
         <meta name="author" content="Salvador Rodríguez Vihé">
         <meta name="Keywords" content="">
         <meta name="Description" content="">
         <meta http-equiv="Content-Language" content="es">
         <meta name="distribution" content="global">
         <meta name="Robots" content="all">
         
         <meta name="Title" content="Admin Botiga">
        
        <script type="text/javascript" src="javascript/jquery.js"></script>
        <script type="text/javascript" src="../java/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="javascript/menu.js"></script>
        
        <title>Admin Botiga</title>
    </head>
    <body>
        <?php if ($_SESSION["rol"]==1)  {   ?>
         <nav>
            <?php include 'menuAdmin.php';?>
        </nav>
        <br>
        <br>
        <div id="infoEmpresa">
        <ul>
            <li><em class="titol">Nom companyia:</em> Botiga de camisetas.</li>
            <br>
            <li><em class="titol">Direcció:</em>carrer de girona 10</li>
            <br>
            <li><em class="titol">CIF:</em>00000000</li>
        </ul>
        </div>
        <?php
           }
        ?>
    </body>
</html>
