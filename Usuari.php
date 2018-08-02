<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GestionarPlatsBd
 *
 * @author Salvador
 */
class Usuari {
     // Define la url de conexión para la base de datos sample
    private $_dsn; 
    private $_user;
    private $_password;
    private $_conn;

    public function __construct($dsn,$user,$password) {
        
        $this->_dsn=$dsn;
        $this->_user=$user;
        $this->_password=$password;
        
        try {
            
            $this->_conn = new PDO($this->_dsn,$this->_user, $this->_password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
         
    }
    
    public function insert($nom,$cognoms,$email,$direccio,$poblacio,$codipostal,$nickUsuari,$passwordUsuari) {
        try {
          
             
            $stmt = $this->_conn->prepare("INSERT INTO usuaris_botiga (usuari,password,nom,cognoms,email,direccio,poblacio,codiPostal)"
                            . "VALUES (?,?,?,?,?,?,?,?)");
            
            $stmt->bindValue(1, $nickUsuari, PDO::PARAM_STR);
            $stmt->bindValue(2, $passwordUsuari,PDO::PARAM_STR);
            $stmt->bindValue(3, $nom, PDO::PARAM_STR);
            $stmt->bindValue(4, $cognoms, PDO::PARAM_STR);
            $stmt->bindValue(5, $email, PDO::PARAM_STR);
            $stmt->bindValue(6, $direccio, PDO::PARAM_STR);
            $stmt->bindValue(7, $poblacio, PDO::PARAM_STR);
            $stmt->bindValue(8, $codipostal, PDO::PARAM_STR);

            $stmt->execute();
            
          
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
    }
    
    public function update($nom,$cognoms,$email,$direccio,$poblacio,$codipostal,$id)
    {
        try {

            $stmt = $this->_conn->prepare("UPDATE usuaris_botiga SET nom=?,cognoms=?,email=?,direccio=?,poblacio=?,codiPostal=?"
                            . " where id=?");
            
            $stmt->bindValue(1, $nom, PDO::PARAM_STR);
            $stmt->bindValue(2, $cognoms, PDO::PARAM_STR);
            $stmt->bindValue(3, $email, PDO::PARAM_STR);
            $stmt->bindValue(4, $direccio, PDO::PARAM_STR);
            $stmt->bindValue(5, $poblacio, PDO::PARAM_STR);
            $stmt->bindValue(6, $codipostal, PDO::PARAM_INT);
            $stmt->bindValue(7, $id, PDO::PARAM_INT);

            $stmt->execute();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    public function canviarPassword($password,$id)
    {
         try {

            $stmt = $this->_conn->prepare("update usuaris_botiga set password=? where id=?");
            
            
            $stmt->bindValue(1, $password, PDO::PARAM_STR);
            $stmt->bindValue(2, $id, PDO::PARAM_INT);

            $stmt->execute();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    public function delete($id) {
        try {

            $stmt = $this->_conn->prepare("delete from usuaris_botiga where id=?");
            
            $stmt->bindValue(1, $id, PDO::PARAM_STR);

            $stmt->execute();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    
    public function obtenirUsuari($id){
        
        try {
            
            $select="select * from usuaris_botiga where id=?";
            
            $stmt = $this->_conn->prepare($select);
        
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            $stmt->execute();
           
            return $stmt->fetch();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
        
    }
    
    public function imprimirUusari($id) {
        
        $usuari=  self::obtenirusuari($id);
        
        echo "<div>".
             "<table id='Usuari' align='center'>".
             "<tr><td colspan='2' class='titol'>DADES USUARI:</td></tr>".
             "<tr><td>&nbsp</td></tr>".
             "<tr><td class='camp'>NOM:</td><td>".$usuari['nom']."</td></tr>".
             "<tr><td class='camp'>COGNOMS:</td><td>".$usuari['cognoms']."</td></tr>".
             "<tr><td class='camp'>E-MAIL:</td><td>".$usuari['email']."</td></tr>".
             "<tr><td class='camp'>DIRECCIÓ:</td><td>".$usuari['direccio']."<td></tr>".
             "<tr><td class='camp'>POBLACIÓ:</td><td>".$usuari['poblacio']."<td></tr>".
             "<tr><td class='camp'>CODI POSTAL:</td><td>".$usuari['codiPostal']."<td></tr>".
             "<tr><td></td><td><a class='boto_afegir' rel='shadowbox;width=500;height=300' title='Modificar Usuari' href='modificar_usuari.php?usuari=$id' value='Modificar'>Modificar</a><td></tr>".
             "<tr><td>&nbsp</td></tr>".
             "<form name='password' action='modificar_password.php' method='POST' onsubmit='return validar (this)'>".
             "<tr><td><input type='hidden' id='password' name='password' value='".$_SESSION['password']."'></hidden></td></tr>".
             "<tr><td class='camp'>PASSWORD ANTIC:</td><td><input id='pswdAntic' name='pswdAntic' type='text' size='15'></input><td></tr>".
             "<tr><td class='camp'>PASSWORD NOU:</td><td><input id='pswdNou' name='pswdNou' type='text' size='15'></input><td></tr>".
             "<tr><td></td><td><input id='boto' class='boto_afegir' name='modificarPswd' type='submit' size='8' value='Modificar'></input><td></tr>".
             "</form>".
             "</table></div>";
        
    }
    public function llistarComandes($id)
    {
        try
        {
               $select="select * from comandes where Id_Usuari=?";
            
               $stmt = $this->_conn->prepare($select);
        
               $stmt->bindParam(1, $id, PDO::PARAM_INT);
              
               $stmt->execute();
               
               $comandes=$stmt->fetchAll();
               
               $totalProductes=0;
               $totalImport=0;
             
             echo "<div>".
                  "<table id='Comandes'  align='center'>".
                  "<tr class='cap'><td class='id'>Ref.</td><td class='data'>Data Comanda</td><td class='num'>Num Prod.</td><td calss='total'>Total</td><td>Estat</td><td class='veure'>*</td></tr>";
             for($i=0;$i<count($comandes);$i++)
             {
                  echo "<tr><td>".$comandes[$i]['Id_Comanda']."</td>".
                          "<td>".$comandes[$i]['data']."</td>".
                          "<td>".$comandes[$i]['num_productes']."</td>".
                          "<td>".$comandes[$i]['total']."€</td>";
                  
                          switch($comandes[$i]['estat']){
                              case 0:
                                   echo "<td class='estat'>Pendent</td>";
                                   break;
                               case 1:
                                   echo "<td class='estat'>Confirmat</td>";
                                   break;
                               case 2:
                                   echo "<td class='estat'>Enviat</td>";
                                   break;
                          }
                           
                         echo "<td><a href='veure_comanda.php?id=".$comandes[$i]['Id_Comanda']."' class='boto_veure'>Veure</a></td></tr>";
                         
                         $totalProductes=$totalProductes + $comandes[$i]['num_productes'];
                         $totalImport=$totalImport + $comandes[$i]['total'];
             }
             echo "<tr><td colspan=6 style='text-align:left; padding-left:10px;'>TOTALS</td></tr>";
             echo "<tr class='totals'><td class='id' colspan=2>NºComandes: $i</td><td class='num'>$totalProductes</td><td calss='total' colspan=3>$totalImport €</td></tr>";
             echo "</table></div>";   
        } 
        catch (Exception $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
            
        }   
    }


    public function closeCon()
    {
        $this->_conn=null;
    }
    
}
