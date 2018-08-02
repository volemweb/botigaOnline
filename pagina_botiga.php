<?php
include './conexio_bd/dades_conexio.php';
require_once 'Botiga.php';
require_once 'Carro.php';
require_once './paginacio/Paginacio.php';
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
       <!-- <meta http-equiv="content-type" content="text/html" charset="UTF-8">-->
       <!--<meta http-equiv="content-type" content="text/html" charset="ISO-8859-15">-->
       <meta charset="UTF-8"> <!-- s'aplica aixi en HTML5 -->
        
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
        
        <title>Botiga Online</title>
        
         <script>
            
         $(document).ready(function()
          {   
              //var idCompanyia;
              $("#company").change(
                      function(){
                           // idCompanyia = $("#company option:selected ").val();
                           // alert("Ha cambiat");
                           $.ajax({
						url:"obtenirLineas.php",
						type: "POST",
						data:"idcompany="+$("#company").val(),
						success: function(opciones){
							$("#linea").html(opciones);
						}
					})
                          
                             
                      });
                      
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
        
         <nav>
            <?php include 'menuprincipal.php';?>
        </nav>
        
        <div id="contingut">
            
          <div id="sercador">
            <?php  
            
            
            $TAMANY_PAGINA=6;
            
             if(isset($_GET["pag"]))
             {
                 $pagina=$_GET["pag"];
                 
                 if($pagina==1)
                 {
                     $inici=0;
                     $final=$TAMANY_PAGINA-1;
                 }
                 else 
                 {
                 
                 $num=$pagina-1;
                 
                 $inici=($TAMANY_PAGINA*$num);
                 $final=($TAMANY_PAGINA*$pagina)-1;
                 }          
             }
             else
             {
                 $inici=0;
                 $final=$TAMANY_PAGINA-1;
                 
                 $pagina=1;
                 
                 $botiga=new Botiga($dsn, $user, $password, @$_SESSION["iniciada"]);
                 
                 $_SESSION["botiga"]=$botiga; 
                
             }
            
             if( ! empty($_SESSION["botiga"]))
             {
                 $companyies=$_SESSION["botiga"]->obtenirCompanyies();
             }
            
            
            ?>
              
              <div id="ajuda">
                  *Pots filtrar la teva busqueda per companyia i per linea.</br>
                  *Pots realitzar una busqueda per nom del producte.
              </div>
              <a id="ajudaLink">[Ajuda]</a>
              </br></br>
              <table id="selects" class="estil" >
                <form method="POST" name="frm_companyia" action="pagina_botiga.php">
                  <tr>
                      <td>Companyia:
                          <select id="company" name="companyia">
                              <option id="opcio" value="0">Totes....</option>
                        <?php 
                         foreach($companyies as $nomCom)
                         {
                           echo "<option id='opcio' value='".$nomCom['IdNumber']."'>".$nomCom['Name']."</option>";
                         }
                        ?> 
                        </select>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Linea:
                   <select id="linea" name="linea">
                     <option id="opcio" value="0">Totes....</option>
                     <?php 
                     foreach($lineas as $nomLin)
                     {
                       echo "<option value='".$nomLin['IdNumber']."'>".$nomLin['Name']."</option>";
                     }
                     ?> 
                   </select>
                   </td>
                   
                    <td> <input id="btnCompanyia" type="submit" value="Buscar" name="buscarCom"></td>
                  </tr>
                </form>
               </table>
              
              <div id="buscar" class="estil">
                <?php  echo "<br>" ?>
                <form method="POST" name="buscar" action="pagina_botiga.php">
                    <input class="bsc" type="search" placeholder="Buscar" size="18px" name="nomProducte">
                     <input id="btnBuscar" type="submit" value="Buscar" name="buscar">
                </div>
                 
             </div>
         </div>
         
            <div id="llista">
                
            <?php 
            
    
            if(isset($_POST['buscar']))
            {
              if($_POST['nomProducte']!='')
              {
                  echo "<div id='paraulaClau'>Busqueda: ".$_POST['nomProducte']."</div>";
                  echo '</br>';
                  $_SESSION['botiga']->llistatProductesBuscar($_POST['nomProducte']);
                  
                  $num_total_files=$_SESSION['botiga']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                  
                  if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
            
                  $paginacio->__toString();
                  }
              }
              else 
              {
                  $_SESSION['botiga']->llistatProductes($inici,$TAMANY_PAGINA);
                  
                  $num_total_files=$_SESSION['botiga']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                  
                  if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
            
                  $paginacio->__toString();
                  }
              }     
            }
            else if(@$_POST['buscarCom'])
            {   
                $companyia=$_POST["companyia"];
                $linea=$_POST["linea"];
            
                
                if($companyia==0 && $linea==0)
                {
                  $_SESSION['botiga']->llistatProductes($inici,$TAMANY_PAGINA);
                  
                  $num_total_files=$_SESSION['botiga']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                  
                  if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
            
                  $paginacio->__toString();
                  }
                }
                else if ($companyia!=0 && $linea==0)
                {
                  $_SESSION['botiga']->llistatProductesCompanyia($companyia);
                
                   $num_total_files=$_SESSION['botiga']->totalFiles();
                   $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                 
                   $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                
                  if($num_total_files>0)
                  {
                     $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
            
                     $paginacio->__toString();
                  }
                }
                 else if ($companyia!=0 && $linea!=0)
                {
                  $_SESSION['botiga']->llistatProductesCompanyiaLinea($companyia, $linea);
               
                  $num_total_files=$_SESSION['botiga']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                  
                
                 if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
            
                  $paginacio->__toString();
                  }
                
                 }
            }
            else if(isset($_GET["pag"]))
            {
                if( ! empty($_SESSION["botiga"]))
                {
                
                  $num_total_files=$_SESSION['botiga']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                 
                  if($num_total_files>0)
                  {
                    $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
                    $paginacio->__toString();
                  }
                }
            }
            else 
            {
                  $_SESSION['botiga']->llistatProductes();
                  
                  $num_total_files=$_SESSION['botiga']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botiga']->imprimirLlistat($inici,$final,$num_total_files);
                  
                  if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"pagina_botiga.php");
            
                  $paginacio->__toString();
                  }
            }
            
             if( ! empty($_SESSION["botiga"]))
                {
                   $_SESSION['botiga']->closeCon();
                }
            
            ?>
                
            </div>
            
        </div>
        
        <footer>
            <section>
                <?php include 'peupagina.php';?>
            </section>
        </footer>
    </body>
</html>
