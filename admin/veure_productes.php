<?php
include '../conexio_bd/dades_conexio.php';
require_once '../Botiga.php';
require_once '../paginacio/Paginacio.php';
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
        <link rel="stylesheet" type="text/css" href="css/admin.css">
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
        
        <title>Veure Productes</title>
        
        <script>
        $(document).ready(function()
          {   
              //var idCompanyia;
              $("#company").change(
                      function(){
                          // idCompanyia = $("#company option:selected ").val();
                          // alert("Ha cambiat");
                           $.ajax({
			  			url:"obtenirLineasAdmin.php",
			 			type: "POST",
			 			data:"idcompany="+$("#company").val(),
						success: function(opciones){
							$("#linea").html(opciones);
						}
					});
                                    });
                          
                             
                      });
        
        </script>
    </head>
    <body>
        
         <nav>
            <?php include 'menuAdmin.php';?>
         </nav>
        <?php
            
            if ($_SESSION["rol"]==1)  { 
                               
             $TAMANY_PAGINA=10;
            
             if(isset($_GET["pag"]))
             {
                 $pagina=$_GET["pag"];
                 
                 $companyies=$_SESSION["botigaAdmin"]->obtenirCompanyies();
                 
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
                
                 $pagina =1;
                 $botigaAdmin=new Botiga($dsn, $user, $password, $_SESSION['iniciada']);
                 
                 $_SESSION["botigaAdmin"]= $botigaAdmin;
                 
                 
                  if( ! empty($_SESSION["botigaAdmin"]))
                  {
                      $companyies=$_SESSION["botigaAdmin"]->obtenirCompanyies();
                  }
                  else{ Echo 'Error : no s ha inicialitzat cap objecte classe botiga';}
             }
                 
            ?>
        
        
        <br>
        <br> <!--Aquest dos salts de linea els poso per donar espai al menu. -->
        
        <aside id="contingutPagina">
               
            <div class="titol"> 
                <h1>LListar productes de la botiga</h1>
            </div>
            
            <div>
               <form method="POST" name="frm_companyia" action="veure_productes.php">
                <table>
                  <tr>
                      <td>Companyia:
                          <select id="company" name="companyia">
                              <option id="opcioCompanyia" value="0">Totes....</option>
                        <?php 
                        
                         foreach($companyies as $nomCom)
                         {
                           echo "<option id='opcio' value='".$nomCom['IdNumber']."'>".$nomCom['Name']."</option>";
                         }
                         
                        ?> 
                        </select>
                      </td>
                  
                
                      <td>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Linea:
                   <select id="linea" name="linea">
                   <option id="opcioLinea" value="0">Totes....</option> 
                   </select>
                   </td>
               
                    <td> <input id="btnCompanyia" type="submit" value="Veure" name="buscarCom"></td>
                  </tr>
               </table>
               </form>
                   
            <?php
                       
           if(@$_POST['buscarCom'])
            {   
                $companyia=$_POST["companyia"];
                $linea=$_POST["linea"];
            
                
                if($companyia==0 && $linea==0)
                {
                  $_SESSION['botigaAdmin']->llistatProductes($inici,$TAMANY_PAGINA);
                  
                  $num_total_files=$_SESSION['botigaAdmin']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botigaAdmin']->imprimirLlistatAdmin($inici,$final,$num_total_files);
                  
                  if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"veure_productes.php");
            
                  $paginacio->__toString();
                  }
                }
                else if ($companyia!=0 && $linea==0)
                {
                  $_SESSION['botigaAdmin']->llistatProductesCompanyia($companyia);
                
                   $num_total_files=$_SESSION['botigaAdmin']->totalFiles();
                   $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                 
                   $_SESSION['botigaAdmin']->imprimirLlistatAdmin($inici,$final,$num_total_files);
                
                  if($num_total_files>0)
                  {
                     $paginacio = new Paginacio($total_paginas,$pagina,"veure_productes.php");
            
                     $paginacio->__toString();
                  }
                }
                 else if ($companyia!=0 && $linea!=0)
                {
                  $_SESSION['botigaAdmin']->llistatProductesCompanyiaLinea($companyia, $linea);
               
                  $num_total_files=$_SESSION['botigaAdmin']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botigaAdmin']->imprimirLlistatAdmin($inici,$final,$num_total_files);
                  
                
                 if($num_total_files>0)
                  {
                    $paginacio = new Paginacio($total_paginas,$pagina,"veure_productes.php");
            
                    $paginacio->__toString();
                  }
                
                 }
            }
            else if(isset($_GET["pag"]))
            {
                if( ! empty($_SESSION["botigaAdmin"]))
                {
                
                  $num_total_files=$_SESSION['botigaAdmin']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botigaAdmin']->imprimirLlistatAdmin($inici,$final,$num_total_files);
                 
                  if($num_total_files>0)
                  {
                    $paginacio = new Paginacio($total_paginas,$pagina,"veure_productes.php");
                    $paginacio->__toString();
                  }
                }
            }
            else 
            {
                  $_SESSION['botigaAdmin']->llistatProductes();
                  
                  $num_total_files=$_SESSION['botigaAdmin']->totalFiles();
                  $total_paginas=ceil($num_total_files/$TAMANY_PAGINA);
                  
                  $_SESSION['botigaAdmin']->imprimirLlistatAdmin($inici,$final,$num_total_files);
                  
                  if($num_total_files>0)
                  {
                  $paginacio = new Paginacio($total_paginas,$pagina,"veure_productes.php");
            
                  $paginacio->__toString();
                  }
            }
            
             if( ! empty($_SESSION["botigaAdmin"]))
                {
                   $_SESSION['botigaAdmin']->closeCon();
                }
            
            ?>
                                      
    </div>
                  
        
     </aside>
     <?php
        }
     ?>
    </body>
</html>