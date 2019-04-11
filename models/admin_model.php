<?php

class Admin_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    
// Vraca sve kolone iz tabele reservation
//@return Array    
    public function getReservations() {
        $data = $this->db->select("SELECT name_user, name_massage, date_reservation, time_reservation FROM reservation JOIN user ON reservation.id_user = user.id_user JOIN massage ON reservation.id_massage = massage.id_massage ORDER BY reservation.date_reservation ASC, reservation.time_reservation ASC");
        return $data;
    }

// Vraca sve kolone iz tabele user
//@return Array    
    public function getUsers() {
        return $this->db->select("SELECT * FROM user ORDER BY name_user ASC");
    }

// Vraca sve redove i kolone iz tabele massage_type
//@return Array
    public function getMassType() {
        return $this->db->select("SELECT id_massage_type, name_massage_type FROM massage_type ORDER BY id_massage_type ASC");
    }

// Vraca sve redove i kolone iz tabele massage
//@return Array
    public function getMassages() {
        return $this->db->select("SELECT * FROM massage ORDER BY name_massage ASC");
    }

// Vraca sve redove i kolone iz tabele blog
//@return Array
    public function getBlogs() {
        return $this->db->select("SELECT * FROM blog ORDER BY title_blog ASC");
    }

// Vraca sve kolone za jedan red iz tabele massage
//@param String $id: id massage
//@return Array   
    public function getMassage($id) {
        $data = $this->db->select("SELECT * FROM massage WHERE id_massage = :id_massage", array(
            ":id_massage" => $id
        ));
        return $data[0];
    }

// Vraca sve kolone za jedan red iz tabele user
//@param String $id: id user
//@return Array   
    public function user($id) {
        $data = $this->db->select("SELECT * FROM user WHERE id_user = :id_user", array(
            ":id_user" => $id
        ));
        return $data[0];
    }

// Vraca sve kolone za jedan red iz tabele blog
//@param String $id: id massage
//@return Array   
    public function getBlog($id) {
        $data = $this->db->select("SELECT * FROM blog WHERE id_blog = :id_blog", array(
            ":id_blog" => $id
        ));
        return $data[0];
    }

// Spaja tabele reservation i massage 
// vraca kolone naziv_masaza, datum_rezervacija, vreme_rezervacija za odredjenog korisnika
//@param String $id: id korisnika
//@return Array
    public function reservations($id) {
        $data = $this->db->select("SELECT name_massage, date_reservation, time_reservation FROM `reservation` JOIN `massage` ON reservation.id_massage = massage.id_massage WHERE reservation.id_user = :id_user ORDER BY date_reservation ASC, time_reservation ASC", array(
            ":id_user" => $id
        ));
        return $data;
    }

    public function insertMass($data) {
        $this->db->insert("massage", $data);
    }

    public function editMass($data, $id) {
        $this->db->update("massage", $data, "id_massage = $id");
    }

    public function deleteMass($id) {
            $this->db->delete("massage", "id_massage = {$id}");
    }

    public function insertBlog($data) {
        $this->db->insert("blog", $data);
    }

    public function editBlog($data, $id) {
        $this->db->update("blog", $data, "id_blog = $id");
    }

    public function deleteBlog($id) {
            $this->db->delete("blog", "id_blog = {$id}");
    }

    public function xhrSearchMass($param) {
        $data = $this->getDatabase()->select("SELECT id, name, text, price FROM massages WHERE name LIKE '{$param}%' ORDER BY name ASC");
        echo json_encode($data);
    }

    public function xhrSearchUser($param) {
        $data = $this->getDatabase()->select("SELECT * FROM users WHERE name LIKE '{$param}%' ORDER BY name ASC");
        echo json_encode($data);
    }

    public function xhrSearchBlog($param) {
            $data = $this->getDatabase()->select("SELECT * FROM blogs WHERE title LIKE '{$param}%' ORDER BY title ASC");
            echo json_encode($data);
        
    }




    public function xhrDelMass($param) {
        $this->db->delete("massage", "id_massage = {$param}");
        echo "{}";
    }
    
    public function xhrDelBlog($param) {
        $this->db->delete("blog", "id_blog = {$param}");
        echo "{}";
    }

}
