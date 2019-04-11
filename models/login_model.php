<?php

class Login_model extends Model {

    public function __construct() {
        parent::__construct();
    }

// Proverava da li u bazi postoji korisnik, ako ne postoji
//upisuje podatke u bazu i pravi sesiju    
    public function registration($data) {
        $testName = $this->db->select("SELECT id_user FROM user WHERE name_user = :name_user", array(
            ":name_user" => $data['name_user']
        ));    
        $testEmail = $this->db->select("SELECT id_user FROM user WHERE email_user = :email_user", array(
            ":email_user" => $data['email_user']
        ));
        if (!empty($testName) || !empty($testEmail)) {
            return false;
        }
        $idUser = $this->db->insert("user", array(
            "name_user" => $data["name_user"],
            "password_user" => Hash::create("sha256", $data["password_user"], HASH_PASS_KEY),
            "email_user" => $data["email_user"],
            "gender_user" => $data["gender_user"]
        ));
        if ($idUser != "0") {
            Session::set("loggedin", true);
            Session::set("id", $idUser);
            Session::set("role", "default");
        } else {
            return false;
        }
    }

// Proverava da li u bazi postoji korisnik i ako postoji pravi sesiju
    public function log($data) {
        $check = $this->db->select("SELECT id_user, role_user FROM user WHERE name_user = :name_user AND password_user = :password_user AND email_user = :email_user", array(
            ":name_user" => $data["name_user"],
            ":password_user" => Hash::create("sha256", $data["password_user"], HASH_PASS_KEY),
            ":email_user" => $data["email_user"]
        ));
        
        if (!empty($check)) {
            Session::set("loggedin", true);
            Session::set("id", $check[0]["id_user"]);
            Session::set("role", $check[0]["role_user"]);
            return true;
        } else {
            return false;
        }
    }
    
    
    
    public function xhrUsernameCheck(){
        $check = $this->db->select("SELECT id_user FROM user WHERE name_user = :name_user", array(
            ":name_user" => $_POST["name_user"]
        ));
        if(empty($check)){
            echo 0;
        }else{
            echo 1;
        }
    }
    
    public function xhrEmailCheck(){
        $check = $this->db->select("SELECT id_user FROM user WHERE email_user = :email_user", array(
            ":email_user" => $_POST["email_user"]
        ));
        if(empty($check)){
            echo 0;
        }else{
            echo 1;
        }
    }

}
