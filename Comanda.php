<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comandes
 *
 * @author Salvador
 */
class Comanda {
    
    private $_dsn; 
    private $_user;
    private $_password;
    private $_conn;
    
    private $_idComanda;
    private $_idUsuari;
    private $_data;
    private $_num_productes;
    private $_total;
    private $_estat;

    private $_lineas;

    public function __construct($dsn,$user,$password) {
        
        $this->_dsn=$dsn;
        $this->_user=$user;
        $this->_password=$password;
        $this->_idComanda=0;
        $this->_idUsuari=0;
        $this->_data='0000-00-00';
        $this->_num_productes=0;
        $this->_total=0;
        $this->_estat="Nova";
        $this->_lineas=new ArrayObject();
        
        try {
            
            $this->_conn = new PDO($this->_dsn,$this->_user, $this->_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        } 
    }
    
    public function getIdComanda()
    {
        return $this->_idComanda;
    }
    public function getIdUsuari()
    {
        return $this->_idUsuari;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function getNumProductes()
    {
        return $this->_num_productes;
    }
    public function getTotal()
    {
        return $this->_total;
    }
    public function  getEstat()
    {
        return $this->_estat;
    }
    public function  getLineas()
    {
        return $this->_lineas;
    }


    public function carregarDades($idComanda) 
    {
        try{
            
            $select="select * from comandes where Id_Comanda=?";
            
            $stmt = $this->_conn->prepare($select);
            $stmt->bindParam(1, $idComanda, PDO::PARAM_INT);
            $stmt->execute();
            $comanda=$stmt->fetchAll(); //retorna tots el resultats en una array
            
            
            $this->_idComanda=$comanda[0]['Id_Comanda'];
            $this->_idUsuari=$comanda[0]['Id_Usuari'];
            $this->_data=$comanda[0]['data'];
            $this->_num_productes=$comanda[0]['num_productes'];
            $this->_total=$comanda[0]['total'];
            $this->_estat=$comanda[0]['estat'];
            
        }catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
    }
    public function carregarLineas($idComanda)
    {
        try
        {
            
            $select="Select * from lineas_comandes where Id_comanda=?";         
       
            $stmt = $this->_conn->prepare($select);
            $stmt->bindParam(1, $idComanda, PDO::PARAM_INT);
            $stmt->execute();
            $linea_comanda=$stmt->fetchAll(); //retorna tots el resultats en una array
             
            $this->_lineas=$linea_comanda;
            
            
        }
        catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        
         }
    }
}
