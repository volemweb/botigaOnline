<?php
include './conexio_bd/dades_conexio.php';
require_once 'Comanda.php';
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
        <!--Perque funcioni el shadow box important qe hi haguin els 2 arxius .js i .css -->
        <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <Link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        
        <script type="text/javascript" src="java/menu.js"></script>
        <title></title>
    </head>
    <body>
        <nav>
    <?php include 'menuprincipal.php';?>
        </nav>
         <div id="contingut">
    <?php
      if(!empty($_SESSION['usuari']))
       {
           if($_GET['id'])
           {
               
            echo "<div class='titolEsquerra'>".$_SESSION['usuari']."</div>";
            echo '<br>';
            echo "<div id='menuUsuari'><spam><a href='comandes_usuari.php'>[Comandes]</a></spam><spam><a href='pagina_usuari.php'>[Configuració]</a></spam></div>";
               
            $comanda= new Comanda($dsn, $user, $password);
            $comanda->carregarDades($_GET['id']);
            $comanda->carregarLineas($_GET['id'])
        ?>
        
        </br>
        </br>
        <table id='Usuari' align='center' >
            <tr><td><strong>Num : </strong><?php echo $comanda->getIdComanda(); ?></td></tr>
            <tr><td><strong>Data : </strong><?php echo $comanda->getData(); ?> </td></tr>
            <tr><td><strong>Estat :</strong>
                <?php 
                   switch($comanda->getEstat()){
                              case 0:
                                   echo "Pendent";
                                   break;
                               case 1:
                                   echo "Confirmat";
                                   break;
                               case 2:
                                   echo "Enviat";
                                   break;
                          }
                   ?></td>
            </tr>
        </br>
        <tr><td>&nbsp;</td></tr>
        <?php
        $lineas=$comanda->getLineas();
        $totalIva=$comanda->getTotal();
 
        $Base=round($totalIva/1.21,2);
        $Iva=round($Base*0.21,2);
        echo "<tr><td><strong>Producte</strong></td><td align='center'><strong>Qnt</strong></td><td align='center'><strong>Preu</strong></td></tr> ";
        for($i=0;$i<count($lineas);$i++)
             {
                              
                   echo "<tr>";
                   
                   echo "<td>".$lineas[$i]['producte']."</td>"; 
                   echo "<td align='center'>".$lineas[$i]['quantitat']."</td>";
                   echo "<td align='center'>".$lineas[$i]['preu']."€</td>";
                   echo "</tr>";
             }
        echo "<tr><td colspan=3><hr></td></tr>";
        echo "<tr><td></td><td align='center'>".$comanda->getNumProductes()."</td><td align='center'>".$totalIva."€</td></tr> ";
        echo "<tr><td>&nbsp<td></tr> ";  
        echo "<tr><td colspan=3>Base : $Base €  | Iva(21%) : $Iva € </td></tr> ";  
        echo "<tr><td colspan=3>Total :<strong> $totalIva €</strong></td></tr> ";  
        echo "</table>";
         } 
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
