<?php
include './conexio_bd/dades_conexio.php';
require_once 'Carro.php';
require_once 'Usuari.php';
session_start();
?>
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
        <div id="contingut">
        <?php
           
         if(isset($_GET['usuari']))
            {
              $usuari= new Usuari($dsn, $user, $password);
               
              $dades=$usuari->obtenirUsuari($_GET['usuari']);
               
              echo "<form name='modUsuari' action='modificar_dades_usuari.php' method='POST' onsubmit='return validar (this)'>".
                   "<table id='modUsuari' align='center'>".
                   "<tr><td colspan='2' class='titol'>DADES USUARI:</td></tr>".
                   "<tr><td>&nbsp<input type='hidden' name='id' value='".$_GET['usuari']."'></hidden></td></tr>".
                   "<tr><td class='camp'>NOM:</td><td><input type='text' name='nom' value='".$dades['nom']."'></td></tr>".
                   "<tr><td class='camp'>COGNOMS:</td><td><input type='text' name='cognoms' value='".$dades['cognoms']."'></td></tr>".
                   "<tr><td class='camp'>E-MAIL:</td><td><input type='text' name='email' value='".$dades['email']."'></td></tr>".
                   "<tr><td class='camp'>DIRECCIÓ:</td><td><input type='text' name='direccio' value='".$dades['direccio']."'><td></tr>".
                   "<tr><td class='camp'>POBLACIÓ:</td><td><input type='text' name='poblacio' value='".$dades['poblacio']."'><td></tr>".
                   "<tr><td class='camp'>CODI POSTAL:</td><td><input type='text' name='codiPostal' value='".$dades['codiPostal']."'><td></tr>".
                   "<tr><td></td><td><input type='submit' class='boto_afegir' name='ModificarUsuari' value='Modificar'></input><td></tr>".
                   "<tr><td>&nbsp</td></tr>".
                   "</table>".
                   "</form>";
              
              $usuari->closeCon();
            }
         
        ?>
        </div>
    </body>
</html>
