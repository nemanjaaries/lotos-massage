<?php

class ServiceController extends Controller{

    private $_massage,
            $_massage_type,
            $_reservation,
            $_term;


    function __construct() {
        parent::__construct();

        $this->_massage = new Massage();
        $this->_massage_type = new Massage_type();
        $this->_reservation = new Reservation();
        $this->_term = new Term();

// Ucitavam css i js fajlove        
        $this->view->js = array("service/js/default.js",
                                "service/js/datedropper.js");
        $this->view->css = array("service/css/datedropper.css");
    }

// Ucitavam podatke iz modela i prebacujem ih u polja view-a
// Prikazujem stranicu    
    public function index(){     
        $this->view->types = $this->_massage_type->getAll();
        $this->view->render("service/index");
    }
 
    public function reserves(){
        $id = $_POST['id_term'];
        if($id === '0'){
            Session::flash('error', 'Morate izabrati termin');
            Redirect::to('service');
            die;
        }

        $date = $_POST['date'];
        $id_term = $_POST['id_term'];
        $id_user = Session::get('id');
        $id_massage = $_POST['id_massage'];

        $check = $this->model->getDatabase()->select("SELECT id FROM reservations WHERE date = '{$date}' and id_term = '{$id_term}'");
        if(empty($check)){
            $reservation = $this->_reservation;
            $reservation->id_user = $id_user;
            $reservation->id_massage = $id_massage;
            $reservation->id_term = $id_term;
            $reservation->date = $date;

            $reservation->insert();

            Session::flash('success', 'Uspesno ste rezervisali masazu');
        }else{
            Session::flash('error', 'Trazeni termin je vec rezervisan');
        }
        
        Redirect::to('service');
    }
    
// Prima asinhroni zahtev i poziva metodu iz modela
    public function xhrTerm(){
        $date = $_POST['date'];

        $freeTerms = $this->_term->freeTerms($date);
        echo json_encode($freeTerms);
    }


// Prima asinhroni zahtev i poziva metodu iz modela     
    public function xhrSessionExist(){
        echo Session::get("loggedin")?"postoji":"ne postoji";
    }
    
}

