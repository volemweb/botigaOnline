
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
  
    $nom=utf8_decode($_POST['nom']);
    $cognoms=utf8_decode($_POST['cognoms']);
    $email=utf8_decode($_POST['email']);
    $direccio=utf8_decode($_POST['direccio']);
    $poblacio=utf8_decode($_POST['poblacio']);
    $codipostal=utf8_decode($_POST['codipostal']);
    
    $nickUsuari=utf8_decode($_POST['nickUsuari']);
    $passwordUsuari=utf8_decode($_POST['passwordUsuari']);
    
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
       
        $captcha=$_POST['g-recaptcha-response'];
        $response=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LfZ5BAUAAAAAAyocdZ5yl7roeW0e6jryp707BDy&response='.$captcha);
        $response = json_decode($response, true);
        if($response['success'] === true)
        {
       
         if ( isset($_POST['nom']) && isset($_POST['cognoms']) && isset($_POST['email'])&&
                 isset($_POST['direccio']) && isset($_POST['poblacio']) && isset($_POST['codipostal'])
                && isset($_POST['nickUsuari']) && isset($_POST['passwordUsuari']) )
           {  
                  $usuari=new Usuari($dsn,$user,$password);
          
                  $usuari->insert($nom, $cognoms, $email, $direccio, $poblacio, $codipostal, $nickUsuari, $passwordUsuari);
            
                  $usuari->closeCon();

                  header('Location:entrar_botiga.php');
           }
         else
           {
              $missatge="Falten valors.";
              header('Location:registre.php?missatge='.$missatge);
           }
         }
         else 
         {
             $missatge="Has de marcar el Captcha.";
             header('Location:registre.php?missatge='.$missatge);
         }
      }
      catch (Exception $e){}
    }
 else 
   {
         $missatge="Ja existeix un usuari amb aquest E-MAIL.";
         header('Location:registre.php?missatge='.$missatge);
   }

}


