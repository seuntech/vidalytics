<?php
class MyMemcachedSessionHandler extends SessionHandler
{
    public function read($id)
    {
        $data = parent::read($id);
        if (empty($data)) {
            return '';
        } else {
            return $data;
        }
    }
}

if (!isset($_SESSION)) {
    $myMemcachedSessionHandler = new MyMemcachedSessionHandler();
    session_set_save_handler($myMemcachedSessionHandler);
    session_start();
}

define('AUTH_DOCROOT', dirname(dirname(dirname(__file__))) . '/');
define('MAIN_ROOT', realpath(dirname(__file__)) . '/');



require_once MAIN_ROOT . "/Logger.php";
require_once MAIN_ROOT. "/discount.php";

class engine extends discount
{

    public $current_menu = array();



    public function ativity_log($id, $type, $who, $ip, $event,$browser)
    {

     
    }
    
    





    public function __construct()
    {
        $Logger = new Logger(array('path' => AUTH_DOCROOT . '/log/'));
        $Logger->enable_exception();

        if (self::config('log_error')) {
            $Logger->enable_error();
            $Logger->enable_display_error(self::config('display_error'));
            $Logger->enable_fatal();
            $Logger->enable_method_file(true);
        } else {
            $Logger->enable_display_error(self::config('display_error'));
        }


    }




    public function get_session($session)
    {
        if (!isset($_SESSION[$session])) {
            return false;
        }

        return $_SESSION[$session];
    }


    public function put_session($name, $session)
    {
        $_SESSION[$name] = $session;
    }

    public function destroy_session($session)
    {
        unset($_SESSION[$session]);
    }



  
    

    public function getRealIpAddr()
    {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return trim(explode(",", $ipaddress)[0]);


        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
            {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        //to check ip is pass from proxy
            {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return json_decode($ip, true);
    }


    function toMoney($val, $symbol = '$', $r = 2)
    {

        //$val = (float)$val;
        return $symbol . number_format($val, $r, '.', ',');
        ;
        $n = $val;
        $sign = ($n < 0) ? '-' : '';
        $i = number_format(abs($n), $r);

        return $symbol . $sign . $i;


    }



   
    private function body($call = 1)
    {

        //file_put_contents("ddd.php",json_encode($_REQUEST));


        $request = "";
        if (isset($_REQUEST['u'])) {
            $request = self::safe_html($_REQUEST['u']);
            $request = $request;

        } else {
            $request = "plugin/home";
        }


        //$_REQUEST['s'] = "index";
        if (isset($_REQUEST['s'])) {
            if (empty($_REQUEST['s'])) {
                $_REQUEST['s'] = "";
            }

           
          $request = "plugin/pages/" . $request . self::safe_html($_REQUEST['s']);
                    
        }

        $file = $request . ".php";


        if (file_exists($file)) {
            $file = $file;


        } else {
            $file = "engine/errorpages/404.php";


        }


        $opts = array('http' => array('method' => "GET", 'header' =>
                    "Accept-language: en\r\n" . "Cookie: foo=bar\r\n"));

        ob_start();
        include ($file);
        $output = ob_get_contents();
        ob_end_clean();

        return $output;


    }




    public function getlanguage($what = "")
    {


        $langfile = "en";
        if (self::config('language')) {
            $lfile = self::config('language');
            if (!file_exists(AUTH_DOCROOT . "lang/" . $lfile . ".php")) {
                $langfile = $lfile;
                
            }
        }

        include AUTH_DOCROOT . "lang/" . $langfile . ".php";

        if (!empty($what)) {
            if (isset($lang[$what])) {
                return $lang[$what];
            } else {
                return "??????";
            }
        }

        return $lang;
    }


    function theme_parameter($index = "index", $call = 1)
    {
  
        $langfile = "en";
        if (self::config('language')) {
            $lfile = self::config('language');
            if (file_exists(AUTH_DOCROOT . "lang/" . $lfile . ".php")) {
                $langfile = $lfile;
                
            }
        }

        require_once AUTH_DOCROOT . "lang/" . $langfile . ".php";
        $replacement = $lang;


        $body = self::body($call);
        $themeparameterskey = array_keys($replacement);
        $themeparametersvalue = array_values($replacement);
        $body = str_replace($themeparameterskey, $themeparametersvalue, $body);


        $replacement["{SHIPPING_TOTAL}"] = self::ship_total();
        $replacement["{CART_TOTAL}"] = self::cart_total();
        $replacement["{TOTAL}"] = self::cart_total()+self::ship_total();
        $replacement["{CART_ITEMS}"] = self::cart_product();
        $replacement["{BODY}"] = $body;
        $replacement["{CART_COUNT}"] = self::cart_count();
        $replacement["{SITE_LOCATION}"] = self::config("theme_folder") . self::config("theme");
    

        return $replacement;


    }





    public static function config($key, $default = null)
    {
        static $config;


        if ($config === null) {
            $config = include AUTH_DOCROOT . 'config/config.php';

        }

        return (isset($config[$key])) ? $config[$key] : $default;
    }


    public static function db()
    {

        // Singleton PDO instance
        static $pdo;

        if ($pdo !== null)
            return $pdo;

        // Connect to database
        $pdo = new PDO(self::config('database_dsn'), self::config('database_user'), self::
            config('database_pass'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // http://php.net/manual/en/pdo.error-handling.php
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
        //$pdo->exec("SET CHARACTER SET utf8");

        return $pdo;
    }


    public function getactve_product($limit){
        $row = self::db_query("SELECT * FROM product WHERE status = ? LIMIT $limit",array(1)); 
return $row;
    }

    public function getsingle_product($id){
        $row = self::db_query("SELECT * FROM product WHERE id = ? LIMIT $limit",array($id)); 
return $row;
    }

    public function cart_total(){

        if(self::get_session("cart")){
            $cart = self::get_session("cart");
            
            $total_price = 0;
            foreach ($cart AS $code){
                $row = self::db_query("SELECT * FROM product WHERE code = ? LIMIT 1",array($code)); 
                $id = $row[0]['id'];
                $name = $row[0]['name'];
                $code = $row[0]['code'];
                $price = $row[0]['price'];
            
            $total_price = $total_price+$price;
                    }
            

                    $total_afterdiscount = $total_price - self::generaldiscount();
                    return $total_afterdiscount;
            
                    }else{
                        return 0;
                    }
    }

    public function ship_total(){

        $carttotal = self::cart_total();

        if($carttotal == 0){return 0;}

        $greater = array();
        $less = array();
        $equal = array();

       $row = self::db_query("SELECT * FROM shipping_rules",array()); 
       for($dbc = 0; $dbc < count($row); $dbc++){

        $target = $row[$dbc]['target'];
        $action = $row[$dbc]['action'];
        $value = $row[$dbc]['value'];

        if($action == ">"){
            if($carttotal > $target){
                if(count($greater) > 0){
                    $greaterval = array_values($greater);
                    if($target > $greaterval[0]){
                        $greater = array($target=>$value);
                    }
            }else{
                $greater = array($target=>$value);
            }
              }
        }

        if($action == "="){
          if($carttotal == $target){
            $equal = array($target=>$value);
          }
        }

        if($action == "<"){
            if($carttotal < $target){
                if(count($less) > 0){
                  
                $lessval = array_values($less);

                    if($target < $lessval[0]){
                        $less = array($target=>$value);
                    }
            }else{
                $less = array($target=>$value);
            }
              }  
        }

       }

       $less = array_values($less);
       $equal = array_values($equal);
       $greater = array_values($greater);


      

       if($greater[0] > 0){ return $greater[0];}

       if($equal[0] > 0){ return $equal[0];}

       if($less[0] > 0){ return $less[0];}

       return 0;

    }



    public function remove_cart($code){
       
        if(self::get_session("cart")){
        
            $current = self::get_session("cart");
               $key = null; 
            foreach($current AS $k => $v){

              
            
if($v == $code){
    $key = $k;
}

            }
            if($key !== null){
unset($current[$key]);
                self::put_session("cart",$current);
            }
          
          
            
            }
    }




    public function add_cart($code){
       
if(self::get_session("cart")){

    $current = self::get_session("cart");
    $current[] = $code;
    self::put_session("cart",$current);
    
    }else{
        self::put_session("cart",array($code));
    }
    }


    public function cart_count(){
       
        if(self::get_session("cart")){
        
            return count(self::get_session("cart"));
            
            }else{
                return 0;
            }
            }

  
    public function cart_product(){

        if(self::get_session("cart")){
$cart = self::get_session("cart");



$html = '';
foreach ($cart AS $code){

    $row = self::db_query("SELECT * FROM product WHERE code = ? LIMIT 1",array($code)); 
    $id = $row[0]['id'];
    $name = $row[0]['name'];
    $code = $row[0]['code'];
    $price = $row[0]['price'];

$html .= '<li class="clearfix">
<a href="plugin/removecart.php?code='.$code.'" class="btn btn-danger text-white float-left p-1 mr-2">x</a>
<img src="product/'.$id.'.jpg" height="50" alt="'.$name.'" />
<span class="item-name">'.$name.'</span>
<span class="item-price">'.self::toMoney($price).'</span>
<span class="item-quantity">'.self::getlanguage("{%QUANTITY%}").': 1</span>
</li>';
        }

        return $html;

        }else{
            return '<div class="alert alert-warning" role="alert">
            '.self::getlanguage("{%EMPTY_CART%}").'
          </div>';
        }

    }

    public function db_query($querry, $array, $bool = false) //query/array/count
    {
        $CONN = self::db();
        $result = $CONN->prepare($querry);
        $result->execute($array);

        if ($bool == true) {
            return $result->rowCount();
        }

        if (preg_match("/INSERT INTO/", $querry, $matches)) {
            return $CONN->lastInsertId();
        }

        if (preg_match("/SELECT/", $querry, $matches)) {
            return self::db_select($result, $CONN);
        }

        return $result;
    }


    private function db_select($result, $CONN)
    {
        $arrayrow = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $tmparray = array();
            foreach ($row as $key => $value) {
                if (self::config("filter_sql")) {
                    $tmparray[$key] = $value;
                } else {
                    $tmparray[$key] = $value;
                }
            }
            $arrayrow[] = $tmparray;
        }

        if (count($arrayrow) == 0) {
            //set array as empty
            for ($i = 0; $i < $result->columnCount(); $i++) {
                $columename = $result->getColumnMeta($i);
                $newarrayrow[0][$columename['name']] = null;
            }
            // $newarrayrow = array();
            return $newarrayrow;
        }
        return $arrayrow;
    }

   
    function check_diff_multi($array1, $array2)
    {
        $result = array();
        foreach ($array1 as $key => $val) {
            if (isset($array2[$key])) {
                if (is_array($val) && $array2[$key]) {
                    $result[$key] = check_diff_multi($val, $array2[$key]);
                }
            } else {
                $result[$key] = $val;
            }
        }

        return $result;
    }


}
?>