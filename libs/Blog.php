<?php


    class Blog extends Model{
        public  $id,
                $title,
                $text,
                $created_at;

        public static $table = 'blogs';
        public static $key = 'id';
        public static $className = 'Blog';

        public function __construct(){
			parent::__construct();
        }
        
        public function comments(){
            return $this->hasMany('Comment');
        }


    }