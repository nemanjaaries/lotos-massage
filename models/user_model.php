<?php

class User_model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function select() {
        $data = $this->db->select("select id,user_name,role from user ");
        return $data;
    }

    public function insert() {
        $form = new Form();
        try {
            $form->set("user_name")->sanitize("inputStr")
                    ->validate("minLength", 5)
                    ->validate("maxLength", 15)
                    ->set("password")->sanitize("inputStr")
                    ->validate("minLength", 8)
                    ->validate("maxLength", 20)
                    ->set("role")->sanitize("inputStr")
                    ->submit();
            $data = $form->get();
            $data['password'] = Hash::init("sha256", $form->get('password'), HASH_PASS_KEY);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            header("Location: " . URL . "user");
        }

        $this->db->insert("user", $data);
        header("Location: " . URL . "user");
    }

    public function delete($id) {
        if(Session::get('id') != $id){
            $this->db->delete("user", "id = $id");
        }
        header("Location: " . URL . "user");
    }

    public function edit($id) {
        $data = $this->db->select("select id, user_name, role from user where id = :id", array(":id" => $id));
        if ($data) {
            return $data[0];
        } else {
            header("Location: " . URL . "user");
        }
    }

    public function editSave() {
        
        $form = new Form();
        try {
            $form   ->set("id")
                    ->set("user_name")->sanitize("inputStr")
                    ->validate("minLength", 5)
                    ->validate("maxLength", 15)
                    ->set("password")->sanitize("inputStr")
                    ->validate("minLength", 8)
                    ->validate("maxLength", 20)
                    ->set("role")->sanitize("inputStr");
            $id = $form->get("id");
            $form->submit();
            
            $data = $form->get();
            $id = $form->get("id");
            $data['password'] = Hash::init("sha256", $form->get('password'), HASH_PASS_KEY);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            header("Location: " . URL . "user/edit/$id");
        }
        $this->db->update("user", $data, "id = $id");

        header("Location: " . URL . "user");
    }

}
