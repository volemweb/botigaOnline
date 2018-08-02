<?php

if(session_start())
{
    //Allibero les dos variables
     unset($_SESSION["usuari_admin"]); 
     unset($_SESSION["password_admin"]);
     unset($_SESSION["rol"]);
     
    //Destrueixo la sessio
    session_destroy();
    
     header('Location: index.php');
}
