<?php
include '../conexio_bd/dades_conexio.php';
require_once '../Botiga.php';
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
        
        <title>Veure Productes</title>
        
        <script>
        $(document).ready(function()
          {   
              //var idCompanyia;
              $("#company").change(
                      function(){
                          //  idCompanyia = $("#company option:selected ").val();
                          // alert("Ha cambiat");
                           $.ajax({
						url:"../obtenirLineas.php",
						type: "POST",
						data:"idcompany="+$("#company").val(),
						success: function(opciones){
							$("#linea").html(opciones);
						}
					})
                          
                             
                      });
            });
        
        </script>
    </head>
    <body>
        <?php
            
            if ($_SESSION["rol"]==1)  { 
            
                 $botiga=new Botiga($dsn, $user, $password, $_SESSION['iniciada']);
                 
                 $_SESSION["botiga"]=$botiga;
                 
                  if( ! empty($_SESSION["botiga"]))
                  {
                      $companyies=$_SESSION["botiga"]->obtenirCompanyies();
                  }
                
                 
            
            ?>
         <nav>
            <?php include 'menuAdmin.php';?>
         </nav>
        
        <br>
        <br> <!--Aquest dos salts de linea els poso per donar espai al menu. -->
        
        <aside id="contingutPagina">
               
            <div class="titol"> 
                <h1>LListar productes de la botiga</h1>
            </div>
            
            <div>
                <form method="POST" name="frm_companyia" action="veure_productes.php">
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
                   
                    <td> <input id="btnCompanyia" type="submit" value="Veure" name="buscarCom"></td>
                  </tr>
                </form>
               </table>
            </div>
                  
        
         </aside>
        <?php
           }
        ?>
    </body>
</html>