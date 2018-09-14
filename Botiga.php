<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Botiga
 *
 * @author Salvador
 */
class Botiga {

    private $_dsn; 
    private $_user;
    private $_password;
    private $_conn;
    
    private $_Llistat;
    private $_companyies;
    private $_lineas;
    
    private $_sessio;

    public function __construct($dsn,$user,$password,$sessio) {
        
        $this->_dsn=$dsn;
        $this->_user=$user;
        $this->_password=$password;
        $this->_sessio=$sessio;
        $this->_Llistat=new ArrayObject();
        
        try {
            
            $this->_conn = new PDO($this->_dsn,$this->_user, $this->_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
         
    }
    //He hagut d'afeguir aquesta funció perque em funciones en el panell d'administració
    //Aixo es anomenat metodos magicos
    /*serialize() comprueba si la clase tiene un método con el nombre mágico __sleep(). 
     * Si es así, el método se ejecuta antes de cualquier serialización. 
     * Se puede limpiar el objeto y se supone que devuelve un array con los nombres de todas 
     * las variables de el objeto que se va a serializar. Si el método no devuelve nada, 
     * entonces NULL es serializado y un error E_NOTICE es emitido.
        El uso para el que está destinado __sleep() consiste en confirmar datos pendientes o 
     * realizar tareas similares de limpieza. Además, el método es útil si tiene objetos 
     * muy grandes que no necesitan guardarse por completo.*/
    
    public function __sleep()
    {
      return array( '_dsn','_user','_password','_sessio','_Llistat');
    }
    public function obtenirCompanyies()
    {
        try{
             
            $this->_conn = new PDO($this->_dsn,$this->_user, $this->_password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $select="select IdNumber,Name from companys where Active=1";
            
            $stmt = $this->_conn->prepare($select);
            
            $stmt->execute();
           
            return $stmt->fetchAll(); //retorna tots el resultats en una array
            
        }catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    
     public function obtenirLineas($companyia)
    {
         try
         {
          $this->_conn = new PDO($this->_dsn,$this->_user, $this->_password);
          $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
           $select="select IdNumber,Name from line where Active=1 and CompanyId=?";
            
            $stmt = $this->_conn->prepare($select);
            
            $stmt->bindParam(1, $companyia, PDO::PARAM_INT);
            
            $stmt->execute();
           
            return $stmt->fetchAll(); //retorna tots el resultats en una array
         }
         catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    
    public function totalFiles()
    {
       try
        {
           
             $numFilas= count($this->_Llistat);
             
             return $numFilas;
            
          
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function nomCompayia($id)
    {
         try {
            
            $select="select Name from companys where IdNumber =".$id;
            $stmt = $this->_conn->prepare($select);
            
            $stmt->execute();
            
            $valor=$stmt->fetch();
            
            $valor['Name'];
           
            return $valor['Name'];
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function nomLinea($id)
    {
         try {
            
            $select="select Name from line where IdNumber =".$id;
            $stmt = $this->_conn->prepare($select);
            
            $stmt->execute();
            
            $valor=$stmt->fetch();
            
            $valor['Name'];
           
            return $valor['Name'];
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function llistatProductesCompanyia($companyia)
    {
          try {
            
            $select="select * from products where CompanyId=? and Active=1";
            
            $stmt = $this->_conn->prepare($select);
            
            $stmt->bindParam(1, $companyia, PDO::PARAM_INT);
            
            $stmt->execute();
           
            $this->_Llistat=$stmt->fetchAll();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function llistatProductesCompanyiaLinea($companyia,$linea)
    {
          try {
            
            $select="select * from products where CompanyId=? and lineId=? and Active=1";
            
            $stmt = $this->_conn->prepare($select);
            
            $stmt->bindParam(1, $companyia, PDO::PARAM_INT);
            $stmt->bindParam(2, $linea, PDO::PARAM_INT);
            
            $stmt->execute();
           
            $this->_Llistat=$stmt->fetchAll();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function llistatProductes()
    {
          try {
            
            $select="select * from products where Active=1";
            $stmt = $this->_conn->prepare($select);
            
            $stmt->execute();
           
           $this->_Llistat=$stmt->fetchAll();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function llistatProductesBuscar($nom)
    {
          try {
            
            $select="select * from products where Name like '%".$nom."%' and Active=1";
            $stmt = $this->_conn->prepare($select);
            
            $stmt->execute();
           
            $this->_Llistat=$stmt->fetchAll();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function treureAccents($cadena)
    {
        $no_permitidas= array ("á","é","è","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹","+");
        $permitidas= array ("a","e","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E"," ");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;

    }
    
    public function imprimirLlistat($inici,$final,$num_total_files)
    {
      
        
        if($final>$num_total_files)
        {
            $final=$num_total_files-1;
            
        }
        else if($final==$num_total_files)
        {
            $final=$final-1;
        }
        
        echo "</br>";
        echo "<div id='totalProductes'>Productes: ".$num_total_files."</div>";
        
          $moneda= mb_convert_encoding("€","ISO-8859-15","UTF-8"); //utilitzo aquesta funcio perque es vegi el 
                                                                     // el simblo de Euro amb ISO-8859-15
          $desc;
          $preu;
        
        for($i=$inici;$i<=$final;$i++)
        {  
            
            $idNumber=$this->_Llistat[$i]["IdNumber"];
           
            if($i%2==0) {echo "<div id='esquerra'>";}
            else {echo "<div id='dreta'>";}
            echo "<table id='caixaProductes'>";
            echo "<tr><td class='cap_producte' colspan=3>".self::nomCompayia($this->_Llistat[$i]["CompanyId"])."</td></tr>";
            echo "<tr><td colspan=3>&nbsp;<td></tr>";
            $companyia=self::treureAccents(self::nomCompayia($this->_Llistat[$i]["CompanyId"]));
            $nomArxiu = "../botigaOnline/img_productes/".$companyia."/".self::treureAccents($this->_Llistat[$i]["Name"]).'.jpg';
        
            if (file_exists($nomArxiu)) {
                   echo "<tr><td rowspan=4 ><a rel='shadowbox;width=500;height=400' title='Producte'  href='visualitzar_producte.php?foto=$nomArxiu'><img id='foto' src='$nomArxiu'></img></a></td></tr>";
            } 
            else {
                   echo "<tr><td rowspan=4 ><img id='foto' src='img_productes/generic.jpg'></img></td></tr>";
            }
    
            echo "<tr><td>&nbsp;</td></tr>";
            echo "<tr><td colspan=2 style='padding-left:7px;' >".$this->_Llistat[$i]["Name"]."</td></tr>";
            echo "<tr><td>&nbsp;</td></tr>";
            if($this->_Llistat[$i]["Discount"]>0)
            {
                 echo "<tr><td class='descompte'>".$this->_Llistat[$i]["SellPrice"]."€&nbsp&nbsp".$this->_Llistat[$i]["Discount"]."% Descompte&nbsp&nbsp</td>";
                 $desc=($this->_Llistat[$i]["SellPrice"]*$this->_Llistat[$i]["Discount"])/100;
                 $preu=number_format($this->_Llistat[$i]["SellPrice"]-$desc,2);
            }
            else
            {
               echo "<tr><td>&nbsp;</td>";
               $preu=number_format($this->_Llistat[$i]["SellPrice"],2);
            }
            if($this->_sessio==1 && $this->_Llistat[$i]["Current"]>0 )
            {
                $stock=$this->_Llistat[$i]["Current"];
                echo "<td><a class='boto_afegir' rel='shadowbox;width=500;height=150' title='Afegir Producte'  href='afegir_producte.php?producte=$idNumber&preu=$preu&stock=$stock'>Afegir al Carro</a></input></td></tr>";
            } 
            else if ($this->_Llistat[$i]["Current"]<=0 && $this->_sessio==1  )
            {
                echo "<td><a class='boto_afegir'>No hi ha stock</a></input></td></tr>";
            }
            else 
            {
                 echo "<td><a class='boto_afegir' href='entrar_botiga.php'>Entrar</a></td></tr>";
            }
            echo "<tr><td>Preu :<spam class='preuFinal'> ".$preu."€</spam></td><td class='enStock'>En Stock : <spam>".$this->_Llistat[$i]["Current"]."</spam></td></tr>";
            echo "<tr><td>&nbsp;</td></tr>";
            echo "<tr><td class='desc' colspan=3>".$this->_Llistat[$i]["Description"]."</td></tr>";
            echo "</table>";
            echo "</div>";
            
            
             
        }
    }
    
    public function closeCon()
    {
        $this->_conn=null;
    }
    
}
