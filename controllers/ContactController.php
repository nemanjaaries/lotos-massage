<?php

class ContactController extends Controller{

    public function __construct() {
        parent::__construct();
        $this->view->js = array("about/js/default.js");
    }
    
// Ucitava index stranicu   
    public function index($param = null){
        $this->view->render("contact/index");
    }


    

}

