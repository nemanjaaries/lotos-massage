<?php

class View {

    function __construct() {
        
    }
// Prikazuje stranice na izlaz
//@param String $view: naziv stranice koja ce biti ucitana  
    public function render($view){
        require_once "views/header.php";
        require_once "views/messages.php";
        require_once "views/{$view}.php";
        require_once "views/footer.php";
    }
    

}

