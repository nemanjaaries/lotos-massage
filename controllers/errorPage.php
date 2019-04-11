<?php

class ErrorPage extends Controller{

    function __construct() {
        parent::__construct();
    }

// Prikazuje error stranicu   
    public function index(){
        $this->view->render("error/index");
    }

}

