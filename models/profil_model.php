<?php

class Profil_model extends Model {

    function __construct() {
        parent::__construct();
    }

// Spaja tabele rezervacija i masaza
//@return Array    
    public function getAllReservations(){
        $id = Session::get("id");
        return $this->db->select("SELECT name_massage, date_reservation, time_reservation FROM `reservation` JOIN `massage` ON reservation.id_massage = massage.id_massage WHERE reservation.id_user = :id_user ORDER BY date_reservation ASC, time_reservation ASC", array(
            ":id_user" =>$id
        ));
    }



}
