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
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css"></link>
        
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
        <script type="text/javascript" src="java/menu.js"></script>
        <script type="text/javascript" src="java/jquery.bxslider.js"></script>
        
        <title>Botiga Online</title>
        
        
        <script>
          $(document).ready(function(){
              $('.bxslider').bxSlider({
                auto: true,
                autoControls: true,
                options: 'fade',
                speed: 3000
                
               });
          });
       </script>
    </head>
    <body>
        
        <nav>
            <?php include 'menuprincipal.php';?>
        </nav>
        <aside>
            
        </aside>
        <br><br>
          <div id='contingut'>
            <section id='esquerraIndex'>
                <div id="accesRapid"> 
                    <h1 class="titolIndex">Botiga Online</h1>
                    <a href="pagina_botiga.php">Veure la botiga</a></br></br>
                    <a href="registre.php">Registrat</a></br></br>
                    <a href="entrar_botiga.php">Entra amb el teu usuari</a><br></br>
                 </div>
               
            </section>
            
            <section id='dretaIndex'>
              <div style="position: absolute;"></div>
               <div id="container"> 
                <div id="imatges">
                  <ul class="bxslider">
               
                      <li><img src="img_productes/Nike.png" title="NIKE" /></li>
                      <li><img src="img_productes/QuikSilver.png" title="QUIKSILVER" /></li>
                    <li><img src="img_productes/Adidas.png" title="ADIDAS" /></li>
                  </ul>
                </div>
              </div>
            </section>
        </div>
         <footer>
            <section>
                <?php include 'peupagina.php';?>
            </section>
        </footer>
    </body>
</html>
