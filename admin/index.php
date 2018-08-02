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
        
        <script type="text/javascript" src="../java/jquery-1.2.3.js"></script>
        <script type="text/javascript" src="../ava/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="../java/menu.js"></script>
        
        <title>Admin Botiga</title>
    </head>
    <body>
        
       <div id="contingut">  
        <div id="validarusuaris">
            <h3>Entrar Admin</h3>
            <form method="post" name="usuari" action="comprovar_usuari.php">
                <table>
                    <tr><td>Usuari:</td> <td> <input name="usuari" type="text"></input></td></tr>
                    <tr><td>Password:</td><td><input name="password" type="password"> </input><td></tr>
                    <tr><td></td><td colspan="2"><input type="submit" name="entrar" value="Entrar"></td></tr>
                </table>
            </form>
        </div>
        </div>
        
         
    </body>
</html>
