<?php
require_once 'Carro.php'; // encara que no declaris res ha daver-hi aixo a la pagina

 if (! empty($_SESSION["usuari"]) && ! empty($_SESSION["password"]) && ! empty($_SESSION["carro"]) ) 
  {   
        $numProductes=$_SESSION['carro']->getNumProductes();
?>
<div id="controlSessio">
    <table class="usuari">
    <tr>
        <td>
            <a href="pagina_carro.php"><img width="20px" height="20px" src="imatges/carro.png"> </a>
        </td>
        <td><?php echo $numProductes; ?></td>
    <td>/</td>
    <td><a href="comandes_usuari.php"><?php echo  $_SESSION['usuari'];?></a></td>
    <td><a href="tancar_sessio.php"><img title="Tancar" width="25px" height="25px" src="imatges/off.png"></a></td>
    </tr>
</table>
</div>
<?php
  }




