<?php

class UserController extends Controller{

    function __construct() {
        parent::__construct();
        if(Session::get("role") != "owner"){
            header("Location: ".URL."login");
        }
    }
    
    public function index(){
        $this->view->data = $this->model->select();
        $this->view->render("user/index");
    }
    
    public function insert(){
        $this->model->insert();
    }
    
    public function delete($id){
        $this->model->delete($id);
    }
    
    public function edit($id){
        $this->view->data = $this->model->edit($id);   
        $this->view->render("user/edit");
    }
    
    public function editSave(){
        $this->model->editSave();
    }

}

