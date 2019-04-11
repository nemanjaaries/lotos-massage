<?php

class Controller {

    public function __construct() {
//@var Object $this->view: instanca klase View
        $this->view = new View();
    }
 
// Proverava da li postoji model za trazeni kontroler i ucitava ga
//@param String $file: naziv kontrolera
    public function loadModel($file){
        $path = "models/{$file}_model.php";
        $model = $file."_model";
        if(file_exists($path)){
            require_once $path;
            $this->model = new $model();
        }
    }

}

