<?php
ob_start();//Aixo ho utlitzo per reparar l'error del header si la sessió no esta iniciada
include './conexio_bd/dades_conexio.php';
require_once 'Carro.php';
require_once 'Usuari.php';
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
        <script type="text/javascript" src="java/validarPassword.js"></script>
        <!--Perque funcioni el shadow box important qe hi haguin els 2 arxius .js i .css -->
        <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <Link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        
        <script type="text/javascript" src="java/menu.js"></script>
        <script>
        $(document).ready(function()
          {   
             /*$('#boto').click(
                     function(){
                   
                      if($('#password').val() !== $('#pswdAntic').val())
                      {
                           alert ('El password antic que has entrat no es correcta!!!!!');
                           $('#pswdAntic').focus();
                      }
                      
                      var passwordNou=$('#pswdNou').val();
                      if(passwordNou.length < 6 )
                      {
                           alert ('El password nou ha de tenirr com a minim 6 caracters!');
                           $('#pswdNou').focus();
                      }
              });*/
              
           });
          
           Shadowbox.init({
      //Amb aquesta funcio faig que la pagina es refresqui despres de tancar la finestra d'afeguir productes al carro 
      //aixi s'actualitza el contador de numero de productes del carro de compra.
      
           onClose : function () { 
               
                location.reload();
              }
           
       } );
          
         </script>
        
        <title>Usuari</title>
    </head>
    <body>
         <nav>
            <?php include 'menuprincipal.php';?>
        </nav>
        
        <div id="contingut">
            <?php 
             if(!empty($_SESSION['carro']))
            {
                      echo "<div class='titolEsquerra'>".$_SESSION['usuari']."</div>";
                      echo '<br>';
                      echo "<div id='menuUsuari'><spam><a href='comandes_usuari.php'>[Comandes]</a></spam><spam><a href='pagina_usuari.php'>[Configuració]</a></spam></div>";
                      
                      $usuari= new Usuari($dsn, $user, $password);
                      
                      echo '<br><br>';
                      
                      if(isset($_GET['missatge']))
                      {
                          if ($_GET['missatge']=='ok')
                          {
                              echo "<div align='center' style='color:red;'>El password s'ha canviat correctemnt!</div>";
                              echo "<br>";
                          }
                          
                      }
                      $usuari->imprimirUusari($_SESSION['id']);
                          
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
