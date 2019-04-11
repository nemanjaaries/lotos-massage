<?php

    class Massage extends Model{
        public  $id,
                $id_massage_type,
                $name,
                $text,
                $price;

        public static $table = 'massages';
        public static $key = 'id';
        public static $className = 'Massage';

        public function __construct(){
			parent::__construct();
        }

        public function type(){
            return $this->belongsTo('Massage_type');
        }
        
    }