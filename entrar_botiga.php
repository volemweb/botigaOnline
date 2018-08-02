<?php
require_once 'Carro.php';
session_start();
/*if(session_start())
{
    //Allibero les dos variables
     unset($_SESSION["usuari"]); 
     unset($_SESSION["password"]);
     unset($_SESSION["carro"]);
     
    //Destrueixo la sessio
    session_destroy();
}
*/?>
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
         
         <meta name="Title" content="Entrar Botiga">
        
        <script type="text/javascript" src="java/jquery-1.2.3.js"></script>
        <script type="text/javascript" src="java/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="java/menu.js"></script>
        
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
        
        <br>
        <br>
        <div id="contingut">  
            <div class="missatge">
                <strong style="font-size:20px;">LA SESSIÓ JA ESTAT INICIADA.</strong></br></br>
                Tanca la sessió si vols entrar amb un altre usuari.</br></br>
                <a class="blau" href="pagina_botiga.php">O click aquí per continuar comprant.</a></div>
        </div>
        
     <?php   }
             else{ ?>  
       <div id="contingut">  
        <div id="validarusuaris">
            <h3 style="color:red">Entrar Botiga</h3>
            <form method="post" name="usuari" action="comprovar_usuari.php">
                <table>
                    <tr><td>Email:</td> <td> <input name="email" type="text" placeholder="exemple@botiga.com"></input></td></tr>
                    <tr><td>Password:</td><td><input name="password" type="password" placeholder="******"> </input><td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td></td><td colspan="2"><input id="btnEntrar" type="submit" name="entrar" value="Entrar"></td></tr>
                    <tr><td colspan="2"><a style="float:right" href="registre.php">Registrarse</a></td></tr>
                </table>
            </form>
        </div>
        </div>
             <?php }?>
        
         <footer>
            <section>
                <?php include 'peupagina.php';?>
            </section>
        </footer>
    </body>
</html>
