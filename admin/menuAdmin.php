<!-- OPCIÓ 1 DE LOGO I IMATGE
<div id="capçaLogo">
    <img class="logo" src="img/logo_generic.png"></img> 
    <p class="texte_cap">
        La teva pàgina web visible per tothom<br>
        Fes coneixer el teu negoci.....
    </p>
    
</div>-->
<!-- OPCIÓ 2 CAPÇALERA LLARGA 
<div id="capçaLogo2">
    <img class="capçalera"  src="img/imatge_cap.png"></img>
</div> -->
<div>
      <?php 
      include 'control_sessio.php'
      ?>
</div>
<br>
<br>
             
        <div id="menu" style="z-index: 1">
            <a class="btn_menu"><span class="icon-menu"></span></a>
            <ul>
                <li class="m">
                    <a class="menuPrincipal0" href="panell_control.php">Botiga</a>
                </li>
                
                
                <li class="m" style="z-index: 1">
                    <a class="menuPrincipal1">Productes</a>
                    <div class="submenu1">
                        <ul>
                           <li><a href="veure_productes.php">Llistar</a></li>
                           <li><a href="#">Entrar Nous</a></li>
                        </ul>
                     </div>
                </li>
                
                <li class="m" >
                    <a class="menuPrincipal2">Comandes</a>
                     <div class="submenu2">
                        <ul>
                           <li><a href="#">Llistar</a></li>
                        </ul>
                     </div>
                </li>
                <li class="m" >
                     <a class="menuPrincipal3">Usuaris</a>
                      <div class="submenu2">
                        <ul>
                           <li><a href="#">Gestionar</a></li>
                        </ul>
                     </div>
                </li>
            </ul>
            
        </div>