<?php
include '../conexio_bd/dades_conexio.php';
session_start();


if(isset($_POST['usuari']))
        {
            
            include ("../conexio_bd/conexio.php");
            
            $query="SELECT id,usuari,password,email,rol ".
                   "FROM usuaris_botiga ".
	           "WHERE usuari='".$_POST['usuari']."' ". 
	           "AND password='".$_POST['password']."'";
             
           $smtp = $conexio->query($query);
           $results=$smtp->rowcount();
           
           $camps=$smtp->fetch();
            
           $conexio=null;
            
          
            
       if($camps['rol']==1)
       {   
              echo $camps['rol'];
          
                         
               $_SESSION['id_admin']=$camps['id'];
               $_SESSION['email_admin']=$camps['email'];
               $_SESSION['usuari_admin']=$camps['usuari'];  
               $_SESSION['password_admin']=$_POST['password'];
               $_SESSION['rol']=$camps['rol'];
               $_SESSION['iniciada']=1;
               
               header('Location: panell_control.php');
        }
        else
        { 
            header('Location: index.php');
            
        }        
 }
        
    ?>
        
      
     </body>
</html>
