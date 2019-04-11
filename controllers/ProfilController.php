<?php

class ProfilController extends Controller{
    private $_reservation,
            $_massage,
            $_term;
    function __construct() {
        parent::__construct();
// Proveravam da li sesija ima pravo pristupa
        $status = Session::get("role");
        if($status != "default"){
            header("Location: ".URL);
            exit();
        }
        $this->_reservation = new Reservation();
// Ucitavam js fajl
        $this->view->js = array("profil/js/default.js");
    }

// Ucitavam podatke iz modela i prebacujem ih u polja view-a
// Prikazujem stranicu     
    public function index(){
        $reservations = $this->_reservation->getAll(array('id_user', '=', Session::get('id')));
        if(!is_array($reservations)){
            $reservations = [$reservations];
        }
        $this->view->reservations = $reservations;
        $this->view->render("profil/index");
    }
 
   
}

