<?php

    
class Blog_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function getAllBlogs(){
        return $this->db->select("SELECT * FROM blog");
    }
    
    public function getOneBlog($id){
        $data = $this->db->select("SELECT * FROM blog WHERE id_blog = $id");
        return $data[0];
    }
    
    public function getAllComments($id){
        return $this->db->select("SELECT text_comment, time_comment, name_user FROM comment JOIN user on comment.id_user = user.id_user WHERE comment.id_blog = :id_blog ORDER BY time_comment DESC", array(
            ":id_blog" => $id
        ));
    }
    
    public function sentComment($data){
        $this->db->insert("comment",$data);
    }

}