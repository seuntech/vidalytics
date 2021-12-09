<?php
//ENcoding
header('Content-Type: text/html; charset=windows-1252' );
ini_set('default_charset', 'windows-1252');


//Call main engine
include "engine.autoloader.php";
new LanguageDetect();

$init = "index";// incase we want to design a login/registration/forgotpassword page 
if(isset($_REQUEST["u"])){$init = htmlentities($_REQUEST["u"]);}


include_once "engine_init.php"; //include "functions.php";





?>
