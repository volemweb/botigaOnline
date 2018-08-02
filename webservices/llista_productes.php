<?php

include '../conexio_bd/conexio.php';

 $select="select IdNumber,Name,SellPrice from products where Active=1";
            
    $stmt = $conexio->prepare($select);
            
    $stmt->execute();
           
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
    
    header("Content-type:text/xml");
    
    echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
    
    echo "<llista_productes>";
    
    foreach($result as $key)
    {
        echo "<producte>";
          
        foreach ($key as $etiqueta=>$value)
        {
           echo "<".$etiqueta.">".$value."</".$etiqueta.">";
        }
        
        echo "</producte>";
        
    }
     echo "</llista_productes>";
        
      
   
        