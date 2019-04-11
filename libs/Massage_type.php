<?php

    class Massage_type extends Model{
        public  $id,
                $name,
                $text,
                $picture;

        public static $table = 'massage_types';
        public static $key = 'id';
        public static $className = 'Massage_type';

        public function __construct(){
            parent::__construct();
        }

        public function massages(){
            return $this->hasMany('Massage');
        }
                
    }