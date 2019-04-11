<?php

// kljuc za hasovanje sifre (ne bi trebalo menjati)
define("HASH_PASS_KEY", "nfdle32j4kl3jr4ldfnvgadf");

$root_website_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/massage/";

$query = $_SERVER['QUERY_STRING'];
$controllerName = explode("=", $query);

$current_location = ($query != NULL)? $root_website_link."views/".$controllerName[1]: $root_website_link."views/index/";

//apsolutna putanja aplikacije
define("URL", $root_website_link);
//apsolutna putanja do view-a pozvanog kontrlolera
define("URL_CURRENT", $current_location);

//konfiguracione globalne
$GLOBALS['config'] = array(
    'app' => array(
        'algo' => PASSWORD_BCRYPT,
        'cost' => 10
    ),
    'auth' => array(
        'session' => 'user_id',
        'remember' => 'user_r'
    ),
    'database' => array(
        'type' => 'mysql',
        'host' => '127.0.0.1',
        'name' => 'massage',
        'username' => 'root',
        'password' => ''
    ),
    'cookie' => array(),
    'session' => array()
);


