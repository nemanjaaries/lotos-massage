<?php

class Validator {
    private $_user;

    function __construct() {
        $this->_user = new User();
    }

    public function unique($subject, $field){
        return (count( (array) $this->_user->getAll([$field, '=', $subject])))?'vec postoji u bazi podataka': false; 
    }

    public function minLength($subject, $argument) {
        return (strlen($subject) < $argument) ? "number of character is less then $argument": false;
    }

    public function maxLength($subject, $argument) {
        return (strlen($subject) > $argument) ? "number of character is more then $argument": false;
    }

    public function digits($subject, $field) {
        return (ctype_digit($subject) == false) ? "character isn't digits": false;
    }

    public function email($subject, $field) {
        return (!filter_var($subject, FILTER_VALIDATE_EMAIL)) ? "is not valid email": false;
    }

    public function __call($name, $arguments) {
        throw new Exception("$name method has not exist in class" . __CLASS__);
    }

}
