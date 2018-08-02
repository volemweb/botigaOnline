<?php
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
        
         <link rel="stylesheet" type="text/css" href="css/menuprincipal.css">
         <link rel="stylesheet" type="text/css" href="css/botigaOnline.css">
         <link rel="shortcut icon" type="image/x-icon" href="imatges/favicon.ico" />
        
        <!--Aquest meta el fem servir perque detecti els dispositus mobils etc... -->
         <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
         <meta name="author" content="Salvador Rodríguez Vihé">
         <meta name="Keywords" content="">
         <meta name="Description" content="">
         <meta http-equiv="Content-Language" content="es">
         <meta name="distribution" content="global">
         <meta name="Robots" content="all">
         
         <meta name="Title" content="Shortcuts Shop">
        
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
        <script type="text/javascript" src="java/jquery-1.2.3.js"></script>
        <script type="text/javascript" src="java/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="java/menu.js"></script>
        <script type="text/javascript" src="java/validarFormulari.js"></script>
       
        
        <title>Entrar Botiga</title>
       
    </head>
    <body>
        
         <nav>
            <?php 
            
                include 'menuprincipal.php';
                
                if(@$_GET['missatge'])
                {
                    echo "<div class='missatge'><strong style='font-size:20px;'>".$_GET['missatge']."</strong></div>";
                }
            
            
            ?>
        </nav>
        
         <?php  if(@$_SESSION['iniciada']==1){ ?>  
        
        <div id="contingut">  
            <div class="missatge">
                <strong style="font-size:20px;">LA SESSIÓ JA ESTAT INICIADA.</strong></br></br>
                Tanca la sessió si vols entrar amb un altre usuari.</br></br>
                <a class="blau" href="pagina_botiga.php">O click aquí per continuar comprant.</a></div>
        </div>
        
     <?php   }
             else{ ?>  
        
       <div id="contingut"> 
           <div id="registre">
               <form method="POST" name="dades" action="entrar_usuari.php" onsubmit="return validar (this)">
               
                 <table>
                 <tr><td>&nbsp;</td></tr>
                 <tr><td class="titol_registre" colspan="2"><strong>REGISTRAT:</strong></td></tr>
                 <tr><td class="nomForm">Nom:</td><td><input id="inputReg" type="text" name="nom" placeholder="Nom" value="" size="30"></td></tr>
                 <tr><td class="nomForm">Cognoms:</td><td><input id="inputReg" type="text" name="cognoms" placeholder="Cognoms" value="" size="30"></td></tr>
                 <tr><td class="nomForm">E-mail:</td><td><input id="inputReg" type="mail" name="email" placeholder="Email" value="" size="30"></td></tr>
                 <tr><td class="nomForm">Direcció:</td><td><input id="inputReg" type="text" name="direccio" placeholder="Direcció" value="" size="30"></td></tr>
                 <tr><td class="nomForm">Població:</td><td><input id="inputReg" type="text" name="poblacio" placeholder="Població" value="" size="30"></td></tr>
                 <tr><td class="nomForm">Codi Postal:</td><td><input id="inputReg" type="text" name="codipostal" placeholder="Codipostal" value="" size="30"></td></tr>
                 <tr><td class="nomForm">Usuari:</td><td><input id="inputReg" type="text" name="nickUsuari" placeholder="Usuari" value="" size="30"></td></tr>
                 <tr><td class="nomForm">Password:</td><td><input id="inputReg" type="password" id="password" name="passwordUsuari" placeholder="Password (Min 6 carcaters)" value="" size="30"></td></tr>
                 <tr><td>&nbsp;</td></tr>
                 </table>
               
                <div class="g-recaptcha" data-sitekey="6LfZ5BAUAAAAAK6Xjet4yPuU1dQXhX6Fke76LeTI"></div>
                </br>
                <input id="btnRegistre" type="submit" name="enviar" value="Registrar">
           </form>
           </div>
       </div>
   <?php } ?>
        <footer>
            <section>
                <?php include 'peupagina.php';?>
            </section>
        </footer>
    </body>
</html>
