<?php
include '../conexio_bd/dades_conexio.php';
require_once '../Botiga.php';
session_start();

if(isset($_POST["idcompany"]))
	{
		$opciones = ' <option id="opcio" value="0">Totes....</option>';
               
		$lineas=$_SESSION["botigaAdmin"]->obtenirLineas($_POST["idcompany"]); 
		
                foreach($lineas as $nomLin)
                {
                       $opciones.= "<option value='".$nomLin['IdNumber']."'>".$nomLin['Name']."</option>";
                }

		echo $opciones;
                
	}
        

