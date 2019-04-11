<?php


function autoLoad($class){
    require_once "libs/{$class}.php";
}

// apl_autoload_register automatski ucitava fajl
// iz direktorijuma libs u kome se nalazi klasa koju aplikacija zahteva
spl_autoload_register("autoLoad");

require_once 'config.php';

//@var Object $aplication: instanca klase Bootstrap
$aplication = new Bootstrap();

