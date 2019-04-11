<?php

class AdminController extends Controller {

    private $_user,
            $_reservation,
            $_term,
            $_massage_type,
            $_massage,
            $_blog,
            $_form;

    public function __construct() {
        parent::__construct();
        $this->form = new Form();
// Proveravam da li sesija ima pravo pristupa
        $status = Session::get("role");
        if ($status != "admin") {
            header("Location: " . URL);
            exit();
        }

        $this->_user = new User();
        $this->_reservation = new Reservation();
        $this->_term = new Term();
        $this->_massage_type = new Massage_type();
        $this->_massage = new Massage();
        $this->_blog = new Blog();
        $this->_form = new Form();
// Ucitavam js fajl      
        $this->view->js = array("admin/js/default.js");
    }

// Ucitavam podatke iz modela i prebacujem ih u polja view-a
// Prikazujem stranicu    
    public function index($param = null) {

        //print_r($this->_reservation->getAll());die;
        //print_r($this->_massage->getAll());die;

        $this->view->reservations = $this->_reservation->getAll();
        $this->view->massages = $this->_massage->getAll();
        $this->view->blogs = $this->_blog->getAll();
        $this->view->users = $this->_user->getAll();
        $this->view->massType = $this->_massage_type->getAll();

        // $this->view->reservations = $this->model->getReservations();
        // $this->view->users = $this->model->getUsers();
        // $this->view->massType = $this->model->getMassType();
        // $this->view->massages = $this->model->getMassages();
        // $this->view->blogs = $this->model->getBlogs();
        $this->view->render("admin/index");
    }

// Ucitavam podatke iz modela i prebacujem ih u polja view-a
// Prikazujem stranicu
//@param String $id: parametar poslat kroz url
    public function massage($id) {
        $this->view->massType = $this->_massage_type->getAll();
        $this->view->massage = $this->_massage->getOne($id);
        $this->view->render("admin/massage");
    }

// Ucitavam podatke iz modela i prebacujem ih u polja view-a
// Prikazujem stranicu
//@param String $id: parametar poslat kroz url
    public function user($id) {
        $this->view->user = $this->_user->getOne($id);
        $reservations = $this->_reservation->getAll(array('id_user', '=', $id));
        if(!is_array($reservations)){$reservations = [$reservations];}
        $this->view->reservations = $reservations;
        $this->view->render("admin/user");
    }

// Ucitavam podatke iz modela i prebacujem ih u polja view-a
// Prikazujem stranicu
//@param String $id: parametar poslat kroz url
    public function blog($id) {
        $this->view->blog = $this->_blog->getOne($id);
        $this->view->render("admin/blog");
    }

    public function insertMass() {
            $this->_form
                    ->set("id_massage_type")->sanitize("inputStr")
                        ->validate("minLength", 1)->validate("digits")
                    ->set("name_massage")->sanitize("inputStr")
                        ->validate("minLength", 1)
                    ->set("text_massage")->sanitize("inputStr")
                        ->validate("minLength", 1)
                    ->set("price_massage")->sanitize("inputStr")
                        ->validate("minLength", 1)->validate("digits");
            if($this->_form->passes()){
                $massage = $this->_massage;
                $massage->id_massage_type = $this->_form->get('id_massage_type');
                $massage->name = $this->_form->get('name_massage');
                $massage->text = $this->_form->get('text_massage');
                $massage->price = $this->_form->get('price_massage');

                $massage->insert();
                Redirect::to('admin');
            }else{
                echo 'nije proslo';
            }
    }

    public function editMass() {
            $this->_form
                    ->set("id_massage")
                        ->validate("digits")
                    ->set('id_massage_type')
                        ->validate('digits')
                    ->set("name_massage")->sanitize("inputStr")
                        ->validate("minLength", 1)
                    ->set("text_massage")->sanitize("inputStr")
                        ->validate("minLength", 1)
                    ->set("price_massage")->sanitize("inputStr")
                        ->validate("minLength", 1)->validate("digits");

            if($this->_form->passes()){
                $massage = $this->_massage->getOne($this->_form->get('id_massage'));
                $massage->id_massage_type = $this->_form->get('id_massage_type');
                $massage->name = $this->_form->get('name_massage');
                $massage->text = $this->_form->get('text_massage');
                $massage->price = $this->_form->get('price_massage');
                
                $massage->update();
                Redirect::to('admin');
            }else{
                echo 'nije proslo';
            }    
    }



    public function deleteMass($id) {
        $this->_massage->remove($id);
        Redirect::to('admin');
    }

    public function insertBlog() {
        $this->_form
                ->set("title_blog")->sanitize("inputStr")
                    ->validate("minLength", 1)
                ->set("text_blog")->sanitize("inputStr")
                    ->validate("minLength", 1);

        if($this->_form->passes()){
            $blog = $this->_blog;
            $blog->title = $this->_form->get('title_blog');
            $blog->text = $this->_form->get('text_blog');
            
            $blog->insert();
            Redirect::to('admin');
        }else{
            echo 'nije proslo';
        }
    }

    public function editBlog() {
        $this->_form
                ->set("id_blog")
                    ->validate("digits")
                ->set("title_blog")->sanitize("inputStr")
                    ->validate("minLength", 1)
                ->set("text_blog")->sanitize("inputStr")
                    ->validate("minLength", 1);
        if($this->_form->passes()){
            $blog = $this->_blog->getOne($this->_form->get('id_blog'));
            $blog->title = $this->_form->get('title_blog');
            $blog->text = $this->_form->get('text_blog');
            $blog->update();
            Redirect::to('admin');
        }else{
            echo 'nije proslo';
        }     
    }

    public function deleteBlog($id) {
        $this->_blog->remove($id);
        Redirect::to('admin');
    }


    //funkcija koristi stari model
    public function xhrSearchMass() {
        $this->_form
                ->set("name_massage")->sanitize("inputStr");
        if($this->_form->passes()){
            $data = $this->_form->get("name_massage");
            $this->model->xhrSearchMass($data);
        }else{
            echo 'greska';
        }
    }

    //funkcija koristi stari model
    public function xhrSearchUser() {
        $this->_form
                ->set("name_user")->sanitize("inputStr"); 
        if($this->_form->passes()){
            $data = $this->_form->get("name_user");
            $this->model->xhrSearchUser($data);
        }else{
            echo 'greska';
        }
    }

    //funkcija koristi stari model
    public function xhrSearchBlog() {
        $this->_form
                ->set("title_blog")->sanitize("inputStr");
        if($this->_form->passes()){
            $data = $this->_form->get("title_blog");
            $this->model->xhrSearchBlog($data);
        }else{
            echo 'greska';
        }
    }

    public function xhrDelMass() {
        $this->_form
                ->set("id_massage")->sanitize("inputStr")
                    ->validate("digits");
        if($this->_form->passes()){
            $this->_massage->remove($this->_form->get('id_massage'));
            echo '{}';
        }else{
            echo 'greska';
        }
       
    }

    public function xhrDelBlog() {
        $this->_form
                ->set("id_blog")->sanitize("inputStr")->validate("digits");
        if($this->_form->passes()){
            $this->_blog->remove($this->_form->get('id_blog'));
            echo '{}';
        }else{
            echo 'greska';
        }
    }

}
