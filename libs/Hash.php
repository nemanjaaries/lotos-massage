<?php


class Hash {
    private static $instance = null;

    private function __construct() {

    }

    public function getInstance(){
        if(!self::$instance){
            self::$instance = new Hash();
        }
        return self::$instance;
    }
    
// Kriptuje podatke
//@param String $alg: naziv algoritma koji zelimo da primenimo pri kriptovanju
//@param String $password: vrednost podatka koji zelimo da kriptujemo
//@param String $key: vrednost podatka koji se ubacuje u proces kriptovanja
//@return String; vraca kriptovanu vrednost    
    // public static function create($alg, $password, $key){
    //     $hash = hash_init($alg, HASH_HMAC, $password);
    //     hash_update($hash, $key);
    //     return hash_final($hash);
    // }

    public function password($password){
        return password_hash($password, Config::get('app/algo'));
    }

    public function check($password, $hash){
        return password_verify ($password , $hash);
    }

}

