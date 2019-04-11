<?php

require 'form/Validator.php';
require 'form/Cleaner.php';

class Form {
    //@var array $postData sadrzi podatke iz posta
    private $postData = array();
    
    //@var string $currentField trenutni kljuc niza $postData 
    private $currentField = null;
    
    //@var array $errors sadrzi sve greske koje validator vrati
    private $errors = array();
    
    //@var object objekat klase Cleaner
    private $cleaner = array();

    //@var object objekat klase Validator
    private $validator = array();
    
    function __construct() {
        $this->cleaner = new Cleaner();
        $this->validator = new Validator();
    }
    
    //set - puni niz $postData podacima iz posta i vraca objekat klase Form
    //@param string $field polje posta
    public function set($field){
        $this->postData[$field] = $_POST[$field];
        $this->currentField = $field;
        return $this;
    }
    
    //get - vraca niz $postData ili vrednost odredjenog polja
    //@param string $field polje posta
    public function get($field = null){
        if($field){
            if(isset($_POST[$field])){
                return $this->postData[$field];
            }else{
                return false;
            }        
        }else{
            return $this->postData;
        }
    }
    
    public function sanitize($typeOfCleaner){
       $cleanPost = $this->cleaner->{$typeOfCleaner}($this->postData[$this->currentField]);
       $this->postData[$this->currentField] = $cleanPost;
        return $this;
    }
    
    //validate - proverava post podatke
    //@param string $typeOfValidator metoda objekta validator
    //$param mixed $argument 
    public function validate($typeOfValidator, $argument = null){
        if($argument){
           $error = $this->validator->{$typeOfValidator}($this->postData[$this->currentField], $argument);
        }else{
           $error = $this->validator->{$typeOfValidator}($this->postData[$this->currentField], $this->currentField);
        }
        if($error){
            $this->errors[$this->currentField] = $error;
        }
        return $this;
    }
    
    //submit - proverava da li ima gresaka i izbacuje exception ako ima
    public function passes(){
        if (empty($this->errors)){
            return true;
        }else{
            return false;
            // $str = '';
            // foreach($this->errors as $key => $value){
            //     $str .= $key."=>".$value."\n";
            // }
            // throw new Exception($str);
        }
    }

    public function errors(){
        $str = '';
        foreach($this->errors as $key => $value){
            $str .= $key."=>".$value."\n";
        }
        return $str;
    }

}
