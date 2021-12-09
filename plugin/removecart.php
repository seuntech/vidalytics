<?php 
include "../engine.autoloader.php";

if(isset($_REQUEST['code'])){

    $code = $_REQUEST['code'];
$engine->remove_cart($code);


}
?>

<meta http-equiv="refresh" content="0;url=../" />
