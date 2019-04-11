<?php

class Cleaner {

    function __construct() {
        
    }
    
    public function email($subject){
        return filter_var($subject, FILTER_SANITIZE_EMAIL);
    }
    
    public function inputStr($subject){  
        return filter_var($subject, FILTER_SANITIZE_STRING);
        }
        
    public function __call($name, $arguments) {
        throw new Exception("$name method has not exist in class".__CLASS__);
    }

}

