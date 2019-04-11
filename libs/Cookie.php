<?php

class Cookie {

    function __construct() {
        
    }
    
    public static function set($name, $value, $time = 1000){
        setcookie($name, $value, time() + $time);
    }
    
    public static function get($name){
        if(isset($_COOKIE[$name])){
            return $_COOKIE[$name];
        }
    }

}

