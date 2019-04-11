<?php

    class Comment extends Model{
        public  $id,
                $id_blog,
                $id_user,
                $text,
                $created_at;

        public static $table = 'comments';
        public static $key = 'id';
        public static $className = 'Comment';

        public function __construct(){
			parent::__construct();
        }

        public function blog(){
            return $this->belongsTo('Blog');
        }

        public function user(){
            return $this->belongsTo('User');
        }

        
        
    }