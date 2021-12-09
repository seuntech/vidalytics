**INSTALLATION**

Creat a database on mysql it can be any name

upload  vidalytics.sql located at folder root


**CONFIGURATION**

/config/config.php

/\* DATABASE CONFIGURATION START \*/

'database\_dsn' => 'mysql:dbname=vidalytics; host=localhost;',

'database\_user' => 'root',

'database\_pass' => 'change',

/\* DATABASE CONFIGURATION END \*/

if everything goes well, the app should be accessibe at

http://localhost/vidalytics/




**FOLDER STRUCTURE**

Theme  -> app template folder, we currently have 2 themes ( classic and power), the themes can be switched without shutting down the app 

api -> public rest api relying on system core and configuration

config -> configuration file

engine -> system core, all methods and classes maging the whole system

java -> java files shared by all themes

lang -> language file desgined to be recorednised automatically by browser, but for this project it will be managed from config file

log -> all error log are stored here by date

plugin - > the file managing each section

product - > where images are stored



**SHIPPING RULES**

Shippig rules are set from db, the rule recorgnise the following sign <,>,=

sample screen shot below

<img src="https://buasales.com.1.png" width="350" title="screen shot">







**DISCOUNT RULES**

This file also shows ability to have a configuration file that is integrated to main file, update here or additional configuration or method can be added to the file, without modifiying core engine

*engine*/class/discount.php


**THEME/STYLING**

The app comes with two themes and can be switch by changing it from config file

/config/config.php

'theme'=>'classic', (classic and power)



**LANGUAGE**

/lang

the current supported language are en,es,fr, more language can be created by adding more file on lang folder

the app is meant to sutomatically detect browser language, but for this project it has to be switched manually from config file

/config/config.php

'language'=>'es',//en.fr,es



**ERROR LOG**

Logs can be found in /log folder




**API**

<http://localhost/vidalytics/api/v1/product/productlist.json>

by changing the extension of the rest API, you set the response

e.g .xml , .json, .txt, .printr

more can be implemented like csv, pdf etc 

**Response**

[{"id":"1","name":"Red Widget","code":"R01","price":"32.95","status":"1","date\_added":"2021-12-08 22:25:16"},{"id":"2","name":"Green Widget","code":"G01","price":"24.95","status":"1","date\_added":"2021-12-08 22:26:12"},{"id":"3","name":"Blue Widget","code":"B01","price":"7.95","status":"1","date\_added":"2021-12-08 22:26:34"}]


