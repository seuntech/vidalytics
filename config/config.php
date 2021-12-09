<?php
if(!defined('MENUAUTH_DOCROOT') && !defined('AUTH_DOCROOT')  && !defined('RAUTH_DOCROOT')   && !defined('AUTH_DOCROOTB')){
 exit('No direct script access');
 }


return array(
'version'=>1.0,
'max_request_hits' => '500000',
'max_request_time' => '500000',
'enable_block_ip' => false, #edit ip.ini to add ip to block



/* THEME CONFIGURATION START */
'theme_folder' => 'theme/',
'root_folder'=>'/vidalytics',
'theme'=>'classic',//classic,power
'language'=>'en',//en.fr,es
/* THEME CONFIGURATION END */
   

 #do not edit below manualy unless you know what you are doing
 /* WEBSITE CONFIGURATION START */
'website_root'=>'https://nnnddd.com/',
'author'=>'Seun Makinde',
'app_name'=>'Acme Widget Co',
/* WEBSITE CONFIGURATION END */


/* DATABASE CONFIGURATION START */
'database_dsn' => 'mysql:dbname=vidalytics; host=localhost;',
'database_user' => 'root',
'database_pass' => 'change',
/* DATABASE CONFIGURATION END */

/* DATABASE2 CONFIGURATION START */
'mem_ip' => 'localhost',
'mem_port' => 11211,
/* DATABASE2 CONFIGURATION END */


/* ICON_SIZE CONFIGURATION START */
'icon_size'=>2.0,
/* ICON_SIZE CONFIGURATION END */


'server_address'=>'https://seuntech.com',

#For development purpose
/* LOG CONFIGURATION START */
'log_error' => true, // TRUE or FALSE
'display_error' => false, // TRUE or FALSE
/* LOG CONFIGURATION END */

'staging' => false,

'allow_ipchange' => true

)
 /* ENDING CONFIGURATION START */;/* ENDING CONFIGURATION END */