<?php

if(session_start())
{
    //Allibero les dos variables
     unset($_SESSION["usuari"]); 
     unset($_SESSION["password"]);
     unset($_SESSION["carro"]);
     
    //Destrueixo la sessio
    session_destroy();
    
     header('Location: index.php');
}
