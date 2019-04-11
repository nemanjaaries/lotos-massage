<?php

class Session {

    function __construct() {     
    }

// Poziva session_start ukoliko nije ranije pozvan
    private static function init() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

// Setuje sesiju
//@param String $key: kljuc sesije
//@param Mixed $value: vrednost kljuca
    public static function set($key, $value) {
        self::init();
        $_SESSION[$key] = $value;
    }


// Proverava da li postoji sesija
//@param String $key: kljuc sesije
    public static function exists($key) {
        self::init();
        return (isset($_SESSION[$key]))? true: false;
    }
    

    public static function flash($title, $content = ''){
        if(self::exists($title)){
            $session = self::get($title);
            unset($_SESSION[$title]);
            return $session;
        }else{
            self::set($title, $content);
        }

    }
    
// Vraca vrednost iz sesije
//@param String: opcioni parametar (kljuc koji trazimo)
//@return mixed: vraca vrednost trazenog kljuca ili celu sesiju ukoliko
//parametar nije prosledjen
    public static function get($key = null) {
        self::init();
        if ($key) {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        } else {
            return $_SESSION;
        }
    }
    
// Brise sesiju
    public static function destroy() {
        self::init();
        session_destroy();
    }

}
