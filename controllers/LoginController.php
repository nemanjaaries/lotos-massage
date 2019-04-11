<?php

class LoginController extends Controller {
    private $_user,
            $_form,
            $_hash;

    public function __construct() {
        parent::__construct();
        $this->_form = new Form();
        $this->_user = new User();
        $this->_hash = Hash::getInstance();
        $this->view->js = array("login/js/default.js");
    }

// Prikazuje index stranicu
    public function index() {
        $this->view->render("login/index");
    }

    public function registration() {
        $this->_form
                ->set("name")->sanitize("inputStr")
                    ->validate("minLength", 5)
                    ->validate("maxLength", 20)
                    ->validate("unique")
                ->set("password")->sanitize("inputStr")
                    ->validate("minLength", 8)
                ->set("email")->sanitize("email")
                    ->validate("email")
                    ->validate("unique")
                ->set("gender")->sanitize("inputStr")
                    ->validate("maxLength", 1);

        if($this->_form->passes()){
            
            $this->_user->name = $this->_form->get('name');
            $this->_user->password = $this->_hash->password($this->_form->get('password'));
            $this->_user->email = $this->_form->get('email');
            $this->_user->gender = $this->_form->get('gender');
            $this->_user->role = 'default';

            $user = $this->_user->insert();

            Session::set('loggedin', true);
            Session::set('id', $user->id);
            Session::set('role', $user->role);
            Session::flash('success', 'Uspesno ste se registrovali');

            Redirect::to('service');
        }else{
            echo $this->_form->errors(); die;
        }

    }

    public function log() {
        $this->_form
                ->set("password")->sanitize("inputStr")
                    ->validate("minLength", 8)
                ->set("email")->sanitize("email")
                    ->validate("email");

        if($this->_form->passes()){
            
            $password = $this->_form->get('password');
            $email = $this->_form->get('email');

            if(!empty($user = $this->_user->getAll(array('email', '=', $email)))){
                if($this->_hash->check($password, $user->password)){
                    
                    Session::set('loggedin', true);
                    Session::set('id', $user->id);
                    Session::set('role', $user->role);
                    Session::flash('success', "Uspesno ste se ulogovali");

                    Redirect::to('service');
                }else{
                    Session::flash('error', 'Password nije validan');

                    Redirect::to('login');
                }

            }else{
                Session::flash('error', 'Email nije pronadjen');

                Redirect::to('login');
            }
            
            die;
        }else{
            print_r($this->_form->errors());
            die;
        }

    }
      
    public function xhrUsernameCheck(){
        $this->model->xhrUsernameCheck();
    }
    
    public function xhrEmailCheck(){
        $this->model->xhrEmailCheck();
    }

}
