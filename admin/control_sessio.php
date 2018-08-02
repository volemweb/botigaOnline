<?php if ($_SESSION["rol"]==1) {   ?>
<div id="controlSessio">
    <table class="usuari">
    <tr>
    <td><?php echo  $_SESSION['usuari_admin'];?></td>
    <td><a href="tancar_sessio.php"><img title="Tancar" width="25px" height="25px" src="../imatges/off.png"></a></td>
    </tr>
    </table>
</div>
<?php } 




