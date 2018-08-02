<?php

include 'NuSOAP/nusoap.php';

$servicio=new SoapServer();

$ns='urs:miservico';
$servicio->configureWSDL();
