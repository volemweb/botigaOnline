<?php
      try {
            
            $conexio = new PDO("mysql:dbname=botigaOnline;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $conexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }

?>
