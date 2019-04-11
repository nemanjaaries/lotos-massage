<?php

    class User extends Model{
        public  $id,
                $name,
                $password,
                $email,
                $gender,
                $role;

        public static $table = 'users';
        public static $key = 'id';
        public static $className = 'User';

        public function __construct(){
            parent::__construct();
        }

        public function comments(){
            return $this->hasMany('Comment');
        }


    }