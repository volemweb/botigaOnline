<?php
require_once 'Carro.php'; // encara que no declaris res ha daver-hi aixo a la pagina
include './conexio_bd/dades_conexio.php';
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <meta charset="UTF-8"> 
         
         <link rel="stylesheet" type="text/css" href="css/menuprincipal.css">
        <link rel="stylesheet" type="text/css" href="css/botigaOnline.css">
        <Link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        <link rel="shortcut icon" type="image/x-icon" href="imatges/favicon.ico" />
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_GET['producte']))
        {
            
            $id=$_GET['producte'];
            $stock=$_GET['stock'];
            
            
    try {
            
            $moneda= mb_convert_encoding("€","ISO-8859-15","UTF-8");
            
            $conn = new PDO($dsn,$user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $select="select IdNumber,Name from products where IdNumber=?";
            
            $stmt = $conn->prepare($select);
            
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $producte=$stmt->fetch();
          ?>
        <form id="formulari" method="POST" name="form_confirm" action="confirmar_producte.php">
            <table>
                <input type="hidden" name="IdNumber" value="<?php echo $producte['IdNumber']?>">
                <tr><td colspan="4"><input type="hidden" name="Name" value="<?php echo $producte['Name']?>"><?php echo $producte['Name']?></td></tr>
                <tr><td><input type="hidden" name="Preu" value="<?php echo $_GET['preu']?>"><?php echo $_GET['preu'];?>€</td><td>Quant : <input type='number' min='1' max="<?php echo $stock; ?>" value='1' name='Quantitat'><td><td><input class="boto_afegir" type="submit" value="confirmar" name="confirmar"></td></tr>
            </table> 
        </form>
         <?php      
            $conn=null;
            
        } catch (PDOException $ex) {
            echo 'Problema de Conexion: ' . $ex->getMessage();
            throw $ex;
        }
        }
        ?>
    </body>
</html>
