<?php

    class Reservation extends Model{
        public  $id,
                $id_user,
                $id_massage,
                $id_term,
                $date;

        public static $table = 'reservations';
        public static $key = 'id';
        public static $className = 'Reservation';

        public function __construct(){
			parent::__construct();
        }

        public function term(){
            return $this->belongsTo('Term');
        }
        public function massage(){
            return $this->belongsTo('Massage');
        }
        public function user(){
            return $this->belongsTo('User');
        }
        
    }