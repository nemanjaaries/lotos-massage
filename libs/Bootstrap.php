<?php

// class Bootstrap: obradjuje sve zahteve i poziva odgovarajuce kontrolere i metode

class Bootstrap {

    public function __construct() {
       
        $url = isset($_GET['url'])? $_GET['url']:"index";
        $url = rtrim($url,"/");
        $url = explode("/", $url);   

        $file = "controllers/$url[0]Controller.php";
            
        if(file_exists($file)){
            require_once $file;   
        }else{
            $this->error();
            return false;
        }
        
//@var Object $controller: instanca trazenog kontrolera
        $controllerName = $url[0]."Controller";       
        $controller = new $controllerName;
        
// loadModel: ucitava model kontrolera ukoliko postoji
        $controller->loadModel($url[0]);
        
// if naredba: proverava da il je kroz url poslat teci parametar i ako jeste
// postavlja ga kao parametar trazene metode       
        if(isset($url[2])){
            if(method_exists($controller, $url[1])){
                $controller->{$url[1]}($url[2]);
                return;
            }else{
                $this->error();  
                return false;
            }
            
        }
        
        if(isset($url[1])){
            if(method_exists($controller, $url[1])){
                $controller->{$url[1]}();
                return;
            }else{
                $this->error(); 
                return false;
            }           
        }        
        $controller->index();       
    }

// error ucitava error kontroler i poziva metodu index
    private function error(){
        require_once 'controllers/errorPage.php';
        $controller = new ErrorPage();
        $controller->index();
    }

}



    

