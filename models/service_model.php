<?php

class Service_model extends Model {
    
    function __construct() {
        parent::__construct();
    }

// Vraca sve kolone iz tabele masaza
//@return Array
    
    public function getMassType(){
        return $this->db->select("SELECT * FROM massage_type");             
    }
    
    public function getAnticelulit(){
        return $this->db->select("SELECT * FROM massage WHERE id_massage_type = 1");             
    }
    
    public function getRelax(){
        return $this->db->select("SELECT * FROM massage WHERE id_massage_type = 2");             
    }
    
    public function getDetox(){
        return $this->db->select("SELECT * FROM massage WHERE id_massage_type = 3");             
    }

// Proverava da li postoji rezervacija za isti dan i termin, upisuje rezervaciju u bazu
    public function reserves(){
        $check = $this->db->select("SELECT id_reservation FROM reservation WHERE date_reservation = '{$_POST['date']}' and time_reservation = '{$_POST['time']}'");
        if(!empty($check)){
            header("Location: ".URL."service");
            exit();
        }
        $this->db->insert("reservation",array('id_user'=> Session::get("id"),'id_massage'=>$_POST['id_massage'],'date_reservation'=>$_POST['date'],'time_reservation'=>$_POST['time']));
    }

// Ispisuje slobodne termine za rezervaciju
    public function xhrTerm(){
        if(!isset($_POST['date'])){header("Location: ".URL."service");}
        
        $data = $this->db->select("SELECT time_reservation FROM reservations WHERE date_reservation = '{$_POST['date']}'");
        $data1 = $this->db->select("SELECT time FROM terms");
        $offTerm = array();
        foreach ($data1 as $term){
            $offTerm[] = $term['time'];
        }       
        $resTerm = array();
        foreach ($data as $r){
            $resTerm[] = $r['time_reservation'];
        }    
        $freeTerm = array_values(array_diff($offTerm, $resTerm));      
        echo json_encode($freeTerm);
    }
 
// Proverava da li postoji sesija i ispisuje odgovor
    public function xhrSessionExist(){
        
    }
    

}
