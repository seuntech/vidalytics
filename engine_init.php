<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<!-- Twitter -->
<meta name="twitter:site" content="<?php echo $engine->config("app_name");?>">
<meta name="twitter:creator" content="seuntech">
<meta name="twitter:card" content="<?php echo $engine->config("app_name");?>">
<meta name="twitter:title" content="<?php echo $engine->config("app_name");?>">
<meta name="twitter:description" content="<?php echo $engine->config("app_name");?>">
<meta name="twitter:image" content="<?php echo $engine->config("app_name");?>">

<!-- Facebook -->
<meta property="og:url" content="<?php echo $engine->config("app_name");?>">
<meta property="og:title" content="<?php echo $engine->config("app_name");?>">
<meta property="og:description" content="<?php echo $engine->config("app_name");?>">

<meta property="og:image" content="<?php echo $engine->config("app_name");?>">
<meta property="og:image:secure_url" content="<?php echo $engine->config("app_name");?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="600">

<!-- Meta -->
<meta name="description" content="<?php echo $engine->config("app_name");?>">
<meta name="author" content="seuntech">

<link rel="ico" href="/favicon.ico" type="image/png" sizes="16x16"/>
<link rel="shortcut icon" href="/favicon.ico" type="image/png" />


<title><?php echo $engine->config("app_name");?></title>
<script src="<?php echo $engine->config("root_folder");?>/java/jquery-2.1.4.min.js"></script>

    
    <script src="<?php echo $engine->config("root_folder");?>/java/bootstrap/popper.js"></script>
<script src='<?php echo $engine->config("root_folder");?>/java/bootstrap/js/bootstrap.min.js'></script>
<link rel='stylesheet' href='<?php echo $engine->config("root_folder");?>/java/bootstrap/css/bootstrap.min.css'/>    
    <!-- vendor css -->

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?php echo $engine->config("root_folder");?>/<?php echo $engine->config("theme_folder") . $engine->config("theme"); ?>/css/main.css">
    <?php include_once "functions.php"; ?>

  </head>

  <body>

<script src="<?php echo $engine->config("root_folder");?>/java/bootbox/bootbox.all.js"></script> 

<?php
$call = 1;

    $file = $engine->config("theme_folder") . $engine->config("theme") . "/index.php";


$opts = array('http' => array('method' => "GET", 'header' =>
                "Accept-language: en\r\n" . "Cookie: foo=bar\r\n"));
    $context = stream_context_create($opts);
    $file = file_get_contents($file, false, $context);
    $themeparameters = $engine->theme_parameter($init, $call);
    $themeparameterskey = array_keys($themeparameters);
    $themeparametersvalue = array_values($themeparameters);
    $file = str_replace($themeparameterskey, $themeparametersvalue, $file);
    echo $file;


?>









   
  </body>
</html>
