<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_POST['company']))
        {
            include '../conexio_bd/conexio.php';
            
            $id=$_POST['id'];
            $company=$_POST['company'];
            
             try {

            $stmt = $conexio->prepare("INSERT INTO companys (IdNumber,Name,Active)"
                            . "VALUES (?,?,1)");
            
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->bindValue(2, $company, PDO::PARAM_STR);

            $stmt->execute();
            
        } catch (PDOException $ex) {
            echo 'Problema de Consulta: ' . $ex->getMessage();
            throw $ex;
        }
            
        }
        ?>
    </body>
</html>
