<?php

class BlogController extends Controller{

    private $_blog,
            $_user,
            $_comment,
            $_form;

    function __construct() {
        parent::__construct();

        $this->_blog = new Blog();
        $this->_user = new User();
        $this->_comment = new Comment();
        $this->_form = new Form();
        
        $this->view->js = array("blog/js/default.js");
    }
    
    public function index(){
        $this->view->blogs = $this->_blog->getAll();
        $this->view->render("blog/index");
    }
    
    public function oneBlog($id){
        $this->view->blog = $this->_blog->getOne($id);
        $comments = $this->_blog->getOne($id)->comments();
        if(!is_array($comments)){
            $comments = [$comments];
        }
        $this->view->comments = $comments;
        $this->view->render("blog/one");
    }
    
    public function sentComment(){
            $this->_form
                    ->set("id_blog")->sanitize("inputStr")
                        ->validate("minLength", 1)->validate("digits")
                    ->set("id_user")->sanitize("inputStr")
                        ->validate("minLength", 1)->validate("digits")
                    ->set("text_comment")->sanitize("inputStr")
                        ->validate("minLength", 1);
            if($this->_form->passes()){
                $comment = $this->_comment;
                $comment->id_blog = $this->_form->get('id_blog');
                $comment->id_user = $this->_form->get('id_user');
                $comment->text = $this->_form->get('text_comment');

                $comment->insert();
                Redirect::to('blog/oneBlog/'.$this->_form->get('id_blog'));
            }else{
                echo 'nije proslo';
            }
            
    }
    
 

}

