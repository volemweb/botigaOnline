
<?php
/*s'ha de posar "include 'GestionarPlatsBd.php';" abans de la linea 
 *  session_start() perque funcioni correctament.
 * Sino no podrem treballar amb les variables d'aquesta classe dintre de 
 * variables de sessio.
 */
include './conexio_bd/dades_conexio.php';
require_once('Usuari.php');
session_start();

/*Declaro la meva funcio de error que convertira l'error en una excepcio perque o pogui capturar el try.
   * 
   * Li paso el parametres :numero d'error, string error (message), fitxer on ha pasat l'error, linea del error
   * 
   * el throw serveis per llançar l'excepcio i utilitzo la clase ErrorException per convertir l'error en una excepcio */

   function exception_error_handler($errno,$errstr,$errfile,$errline)
   {
     throw new ErrorException($errstr,0,$errno,$errfile,$errline);
   }
        
   /*set_error_handler sirve para Establecer una función de gestión de errores definida por el usuario */
    set_error_handler("exception_error_handler");
    

if(isset($_POST['enviar']))
{
  
    $nom=$_POST['nom'];
    $cognoms=$_POST['cognoms'];
    $email=$_POST['email'];
    $direccio=$_POST['direccio'];
    $poblacio=$_POST['poblacio'];
    $codipostal=$_POST['codipostal'];
    
    $nickUsuari=$_POST['nickUsuari'];
    $passwordUsuari=$_POST['passwordUsuari'];
    
    $missatge="";
    
     include "conexio_bd/conexio.php";
            
     $query="SELECT usuari ".
        "FROM usuaris_botiga ".
        "WHERE email='".$email."' "; 
	          
             
           $smtp = $conexio->query($query);
           $results=$smtp->rowcount();
            
           $conexio=null;
           
    
 if($results==0)
 {
   try
    {
       
         if ( isset($_POST['nom']) && isset($_POST['cognoms']) && isset($_POST['email'])&&
                 isset($_POST['direccio']) && isset($_POST['poblacio']) && isset($_POST['codipostal'])
                && isset($_POST['nickUsuari']) && isset($_POST['passwordUsuari']) )
           {  
                  $usuari=new Usuari($dsn,$user,$password);
          
                  $usuari->insert($nom, $cognoms, $email, $direccio, $poblacio, $codipostal, $nickUsuari, $passwordUsuari);
            
                  $usuari->closeCon();

                  $missatge="Registre fet correctamet. Entra amb el teu email i password.";
                  header('Location:entrar_botiga.php?missatge='.$missatge);
           }
         else
           {
              $missatge="Falten valors.";
              header('Location:registre.php?missatge='.$missatge);
           }
         
     }
    catch (Exception $e){}
    }
 else 
   {
         $missatge="Ja existeix un Usuari amb aquest e-mail!!";
         header('Location:registre.php?missatge='.$missatge);
   }

}


