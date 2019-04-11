<?php

    class Term extends Model{
        public  $id,
                $time;

        public static $table = 'terms';
        public static $key = 'id';
        public static $className = 'Term';

        public function __construct(){
			parent::__construct();
        }

        public function reservations(){
            return $this->hasMany('Reservation');
        }
   
        public function freeTerms($date){
            $terms = $this->getAll();
            $termini = array();
            $id_term = null;
            foreach($terms as $term){
                $res = $term->reservations();
                if(!is_array($res)){
                    $res = [$res];
                }    
                foreach($res as $r){
                    if($r->date == $date){
                        $id_term = $term->id;
                    }
                }  
                if($id_term != $term->id){
                    $termini[] = $term;
                }  
            }
            if(empty($termini)){
                return [$this];
            }
            return $termini;
               











            // $terms = explode(',', $terms);
            // $offered = [1,2,3,4,5,6,7,8];

            // $free = array_values(array_diff($offered, $terms));
            // if(empty($free)){
            //     return [$this];
            // }
            // $arr = array();
            // foreach($free as $id){
            //     $arr[] = $this->getOne($id);
            // }
            // return $arr;
        }
    }