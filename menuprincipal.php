
<script language="javascript">
<!--
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var dayarray=new Array("Diumenge","Dilluns","Dimarts","Dimecres","Dijous","Divendres","Dissabte")
var montharray=new Array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Desembre")

//-->
</script>

<div id="capçaLogo">
            <img class="logo" src="imatges/logoWeb.png"></img>
         <!--   <img class="capImg" src="imatges/imatge_cap.png"></img> -->
             <p class="texte_cap">
              La teva botiga online!!!<br>
              Dels teus productes preferits de sempre.....
             </p>
             
</div>

<div id="data">
    <script language="javascript">
        document.write("<small><font face='Arial'>"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font></small>");
    </script>
</div>

</br>
<div id="menuprincipal">
    <a class="btn_menu"><span class="icon-menu"></span></a>
    <ul>
        <li><a href="index.php">Portada</a></li> <!--id seria opc1 -->
        <li><a href="pagina_botiga.php">Botiga</a></li> <!-- id seria opc2 -->
        <li ><a href="entrar_botiga.php">Entrar</a></li>
    </ul> 
</div>

<div id="submenu">
    <span class="tancar"><img height="20" width="20" src="imatges/tancar.jpg"></span>
    
    <!--<ul class="opc1">
        <li><a href="#">----</a></li>
        <li><a href="#">----</a></li>
        <li><a href="#">----</a></li>
    </ul>
    
    <ul class="opc2">
        <li><a href="entrar_botiga.php">[Entrar Usuari]</a> </li>
        <li><a href="pagina_botiga.php">Botiga</a></li>
    </ul>-->
 
</div>
<?php include 'control_sessio.php';