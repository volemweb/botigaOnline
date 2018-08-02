<?php


//if(isset($_GET['user']) && intval($_GET['user'])){
    
    /*utilizamos la variableque nos viene o la establecemos nosotros 
    $number_posts=isset($_GET['num']) ? isset($_GET['num']) : 10; // 10 es por defecto
    $format=strolower($_GET['format']) =='jason' ? 'json' :'xml'; // xml por defecto
    $user_id=  intval($_GET['user']);*/
    
    
    /*conectamos a la base de datos*/
    $conexio = new PDO("mysql:dbname=botigaOnline;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    $conexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $select="select IdNumber,Name,SellPrice from products where Active=1";
            
    $stmt = $conexio->prepare($select);
            
    $stmt->execute();
           
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //function defination to convert array to xml
    function array_to_xml($array, &$xml_products) {
    foreach($array as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml_products->addChild("$key");
                array_to_xml($value, $subnode);
            }else{
                $subnode = $xml_products->addChild("item$key");
                array_to_xml($value, $subnode);
            }
        }else {
            $xml_products->addChild("$key",htmlspecialchars("$value"));
        }
      }
    }

    //creating object of SimpleXMLElement
$xml_products = new SimpleXMLElement('<?xml version="1.0"?><botiga_info></botiga_info>');

//function call to convert array to xml
array_to_xml($result,$xml_products);

//saving generated xml file
//$xml_file = $xml_products->asXML('products.xml');


echo $xml_products->asXML();

/*success and error message based on xml creation
if($xml_file){
    echo 'XML file have been generated successfully.';
}else{
    echo 'XML file generation error.';
}*/

   /* 
    foreach ($result as $row)
    {
        echo $row['IdNumber'];
        echo $row['Name'];
        echo $row['SellPrice'];
        
    }
    */