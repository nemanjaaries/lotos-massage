<?php

class AboutController extends Controller{

    public function __construct() {
        parent::__construct();
    }
    
// Ucitava index stranicu   
    public function index($param = null){
        $this->view->render("about/index");
    }


    

}

