<?php

class IndexController extends Controller{

    public function __construct() {
        parent::__construct();
        $this->view->js = array("index/js/default.js");
    }
    
// Ucitava index stranicu   
    public function index($param = null){
        $this->view->render("index/index");
    }

// Brise sesiju i redirektuje na pocetnu stranicu    
    public function logout(){
        Session::destroy();
        header("Location: ".URL."login");
    }
    

}

