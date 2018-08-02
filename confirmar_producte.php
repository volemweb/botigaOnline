<?php
require_once 'Carro.php'; // encara que no declaris res ha daver-hi aixo a la pagina
include './conexio_bd/dades_conexio.php';
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
        
        <script type="text/javascript" src="java/jquery-1.2.3.js"></script>
        <script type="text/javascript" src="java/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="java/Jquery.js"></script>
        <!--Perque funcioni el shadow box important qe hi haguin els 2 arxius .js i .css -->
        <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <Link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        <title></title>
          <script>
        $(document).ready(function()
          {   
           /* Ejemple select option amb Jquery
            *   var idCompanyia;
              $("#company").change(
                      function(){
                        idCompanyia = $("#company option:selected ").val();
                });*/
                
              $("#ajudaLink").mouseover(
                      function(event){
                          
                          $("#ajuda").css("display","block");
                      });
              $("#ajudaLink").mouseout(
                      function(event){
                          
                          $("#ajuda").css("display","none");
                      });
          });
                
          
           Shadowbox.init({
      //Amb aquesta funcio faig que la pagina es refresqui despres de tancar la finestra d'afeguir productes al carro 
      //aixi s'actualitza el contador de numero de productes del carro de compra.
      
           onClose : function () { 
               
                location.reload();  
              }
           
       } );
       </script>
       
    </head>
    <body>
        <?php
        if($_POST['confirmar'])
        {
            $id=$_POST['IdNumber'];
            $nomPrd=$_POST['Name'];
            $quantitat=$_POST['Quantitat'];
            $preu=$_POST['Preu'];
            
            try 
            { 
             $_SESSION['carro']->afeguirProducte($id,$nomPrd,$preu,$quantitat);
            
             $num=$_SESSION["carro"]->getNumProductes();
             ?>
             
             <div id='correcta'><strong>Producte guardat correctament!!</strong></div>

            <?php  
            } 
            catch (Exception $ex)
            {
                 echo "<div class='missatge'><strong style='font-size:30px;'>Error al guardar el Producte!!</strong></div>";
            }
            
           
        }
        ?>
    </body>
</html>
