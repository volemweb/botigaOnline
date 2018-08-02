<?php
include './conexio_bd/dades_conexio.php';
require_once 'Carro.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        
        <link rel="stylesheet" type="text/css" href="css/menuprincipal.css">
        <link rel="stylesheet" type="text/css" href="css/botigaOnline.css">
        <link rel="shortcut icon" type="image/x-icon" href="imatges/favicon.ico" />
        
        <!--Aquest meta el fem servir perque detecti els dispositus mobils etc... -->
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
        <title>Comprovar Usuari</title>
    </head>
    <body>
        
         <nav>
            <?php include 'menuprincipal.php';?>
        </nav>
<?php

if(isset($_POST['email']))
        {
            
            include "conexio_bd/conexio.php";
            
            $query="SELECT id,usuari,password,email ".
                   "FROM usuaris_botiga ".
	           "WHERE email='".$_POST['email']."' ". 
	           "AND password='".$_POST['password']."'";
             
           $smtp = $conexio->query($query);
           $results=$smtp->rowcount();
           
           $camps=$smtp->fetch();
            
           $conexio=null;
             
            
          if($results>0)
          {
               /*Si troba alguna fila asigna la variable de sessio i redirigueix al panell*/
              
               $_SESSION['id']=$camps['id'];
               $_SESSION['email']=$camps['email'];
               $_SESSION['usuari']=$camps['usuari'];  
               $_SESSION['password']=$_POST['password'];
               $_SESSION['iniciada']=1;
               $_SESSION['carro']=new carro($dsn, $user, $password) ;
               
               header('Location: pagina_botiga.php');
          }
          else
          {
              echo "<p align='center' class='missatge' style='font-size:20px;'>L'Usuari i la contrasenya no son correctes.</p>";
              echo "<p align='center' class='missatge' style='font-size:18px;'><a href='entrar_botiga.php'><strong>Torna-ho a interntar</strong></a></p>";
              echo "<p align='center' class='missatge' style='font-size:18px;'><a href='registre.php'><strong>Registrar-se</strong></a></p>";
          }
        
        }
        else
        { 
            header('Location: entrar_botiga.php');
            
        }        
         
        
    ?>
        
          <footer>
            <section>
                <?php include 'peupagina.php';?>
            </section>
        </footer>
     </body>
</html>
