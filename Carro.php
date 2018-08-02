<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carro
 *
 * @author Salvador
 */
class Carro {
    
    private $_numProd;
    private $_arrayProd;
    private $_totalCompra;
    
    private $_id;
    
     public function __construct() 
    {
        
        $this->_numProd=0;
        $this->_id=0;
        $this->_totalCompra=0;
    } 
    public function existeixProd($id)
    {
        $i=0;
        $num=-1;
        
        while ($i<$this->_id)
        {
            if($this->_arrayProd[$i]['id']==$id)
            {
                $num=$i;
            }
            $i++;
        }
        
        return $num;
    }
    public function afeguirProducte ($id,$nom,$preu,$quantitat)
    {
        $num=self::existeixProd($id);
        if($num==-1)
        {
        $this->_arrayProd[$this->_id]['id']=$id;
        $this->_arrayProd[$this->_id]['nom']= $nom;
        $this->_arrayProd[$this->_id]['preu']=$preu;
        $this->_arrayProd[$this->_id]['quantitat']=$quantitat;
        $this->_numProd=$this->_numProd+$quantitat;
        
        $this->_id++;
        
       
        }
        else 
        {
          $suma=$this->_arrayProd[$num]['quantitat']+$quantitat;
          $this->_arrayProd[$num]['quantitat']=$suma;
          $this->_numProd=$this->_numProd+$quantitat;
        }
         
    }
    public function eliminarProducte($id)
    {
        $num=self::existeixProd($id);
        
        if($num==$this->_id-1)
        {     
           $this->_id=$num;
           $this->_numProd=$this->_numProd-$this->_arrayProd[$num]['quantitat'];
        }
        else if ($num<$this->_id-1)
        {  
           $this->_numProd=$this->_numProd-$this->_arrayProd[$num]['quantitat'];
             
           for($i=$num;$i<$this->_id;$i++)
           {
              $this->_arrayProd[$i]['id']=$this->_arrayProd[$i+1]['id'];
              $this->_arrayProd[$i]['nom']= $this->_arrayProd[$i+1]['nom'];
              $this->_arrayProd[$i]['preu']=$this->_arrayProd[$i+1]['preu'];
              $this->_arrayProd[$i]['quantitat']=$this->_arrayProd[$i+1]['quantitat'];  
           }
           $this->_id--;
        }
        
    }
    public function getNumProductes()
    {
        return $this->_numProd;
    }
    public function setNumProductes($num)
    {
        $this->_numProd=$num;
    }
    
    public function setTotalCompra($num)
    {
        $this->_totalCompra=$num;
        
    }
    
    public function getTotalCompra()
    {
        return $this->_totalCompra;
    }

    public function getUltimId()
    {
        return $this->_id;
    }
    public function getArrayProd()
    {
        return $this->_arrayProd;
    }
    
    public function ultimaIdComanda($dsn,$user,$password)
    {
        
        try
         {
           $conn2 = new PDO($dsn,$user, $password);
           $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
            $stmt = $conn2->prepare("SELECT MAX(Id_Comanda) as Id from comandes");
           
            $stmt->execute();
           
            $valor= $stmt->fetch();
            
            $conn2=null;
            
            return $valor['Id'];
            
         }
         catch (PDOException $ex) {
            echo 'Problema al obtenir Id Comanda ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    

    public function finalitzarCompra($dsn,$user,$password,$idUsuari)
    {
         try
         {
           $conn = new PDO($dsn,$user, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
            $stmt = $conn->prepare("INSERT INTO comandes (Id_Comanda,Id_Usuari,data,num_productes,total)"
                            . "VALUES (?,?,?,?,?)");
            
            $dataActual=getdate();
            $any=date("Y",$dataActual[0]);
            $mes=date("m",$dataActual[0]);
            $dia=date("d",$dataActual[0]);
    
            //Local $dataActual=$dia."-".$mes."-".$any;
            
            $dataActual=$any."-".$mes."-".$dia;//Online
            
            $numProductes=  self::getNumProductes();
            $total=  self::getTotalCompra();
            $idComanda= self::ultimaIdComanda($dsn,$user,$password);
            $idComanda=$idComanda+1;
            
            $stmt->bindValue(1, $idComanda, PDO::PARAM_INT);
            $stmt->bindValue(2, $idUsuari, PDO::PARAM_INT);
            $stmt->bindValue(3, $dataActual, PDO::PARAM_STR);
            $stmt->bindValue(4, $numProductes, PDO::PARAM_INT);
            $stmt->bindValue(5, $total, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $i=0;
        
             while ($i<$this->_id)
            {
            
               $stmt2 = $conn->prepare("INSERT INTO lineas_comandes (Id_Comanda,producte,quantitat,preu)"
                            . "VALUES (?,?,?,?)");
               
                $stmt2->bindValue(1, $idComanda, PDO::PARAM_INT);
                $stmt2->bindValue(2, $this->_arrayProd[$i]['nom'], PDO::PARAM_STR);
                $stmt2->bindValue(3, $this->_arrayProd[$i]['quantitat'], PDO::PARAM_INT);
                $stmt2->bindValue(4, $this->_arrayProd[$i]['preu'], PDO::PARAM_STR);
            
                $stmt2->execute();
                
                //Desconto els productes
                $stmt3=$conn->prepare("UPDATE products set current=current-? where IdNUmber=? ");
                $stmt3->bindValue(1, $this->_arrayProd[$i]['quantitat'], PDO::PARAM_INT);
                $stmt3->bindValue(2, $this->_arrayProd[$i]['id'], PDO::PARAM_INT);
                
                $stmt3->execute();
  
            $i++;
          }
        
           $this->_arrayProd=null;
           $this->_numProd=0;
           $this->_id=0;
           $this->_totalCompra=0;
           
          $conn=null;
            
         }
         catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
    }
   
    public function __toString() { 
        
       echo "<table id='carro' align=center>
             <tr class='titolCompra'><td colspan='3'>La teva compra:</td></tr>
             <tr class='capCompra'><td></td><td>Quant.</td><td align='right'>Preu</td><td align='right'>Total</td></tr>";
         $totalCompra=0;
         $iva=21;
         for($i=0;$i<$this->_id;$i++)
         {
             $id=$this->_arrayProd[$i]['id'];
             $nom=$this->_arrayProd[$i]['nom'];
            // $nom='Champúú!!';
             $preu=$this->_arrayProd[$i]['preu'];
             $quantitat=$this->_arrayProd[$i]['quantitat'];
             $total= $quantitat * $preu;
             $totalCompra +=$total;
         
         echo "<tr class='lineaCompra'>
                 <td> $nom</td><td align='center'> $quantitat</td><td align='right'>  ".$preu."€ </td><td align='right'>  ".$total."€ </td>
                <td><a title='Elimiar Producte'  href='eliminar_producte.php?producte=$id'>(eliminar)</a></td></tr>";            
         }
         $totalIva=round($totalCompra*$iva/100,2);
         $totalSenseIva=round($totalCompra,2) - $totalIva;
         
         $numProductes=  self::getNumProductes();
         
         echo "<tr><td colspan='4'><hr></td></tr>
         <tr class='lineaCompra'><td colspan='4' align='right'>Total compra (sense iva) : ".$totalSenseIva."€ </td></tr>
         <tr class='lineaCompra'><td colspan='4' align='right'>Total iva (21%) : ".$totalIva."€ </td></tr>
         <tr class='lineaCompra'><td class='total' colspan='4' align='right'><strong>Prod : ".$numProductes."   / Total : ".$totalCompra."€</strong> </td></tr>
         </table>";
         
         self::setTotalCompra($totalCompra);
    }
}
