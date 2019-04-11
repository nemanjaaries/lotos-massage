<?php

class Database {

//@var Object $instance: instanca klase Database
    private static $instance = null;

//ne moze da se instancira spolja
    private function __construct() {
//@var Object $this->conn: instanca klase PDO
        $this->conn = new PDO(Config::get('database/type') . ":host=" . Config::get('database/host') . ";dbname=" . Config::get('database/name'), Config::get('database/username'), Config::get('database/password'));
    }

//@return Object: vraca objekat klase Database
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

// Cita podatke iz tabele
//@param String $sql: upit ka bazi
//@param Array $param: opcioni parametar (kljucevi moraju biti nazvani identicno 
//kao kolone u tabeli iz koje citamo
//@return array
    public function select($sql, $param = array()) {
        $st = $this->conn->prepare($sql);
        foreach ($param as $key => $value) {
            $st->bindValue($key, $value);
        }
        $st->execute();
        $data = [];
        while ($res = $st->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $res;
        }
        return $data;
    }

// Upisuje podatke u tabelu    
//@param String $table: naziv tabele u koju zelimo da upisemo podatke
//@param Array $param: kljucevi moraju biti nazvani identicno kao kolone u koje
//zelimo da upisemo podatke
//@return String: ako je upis uspesno izvrsen vraca poslednji id iz tabele,
//ako nije vraca 0
    public function insert($table, $param) {
        $data = array_keys($param);
        $colName = "`" . implode($data, "`,`") . "`";
        $paramMask = ":" . implode($data, ",:");
        $sql = "INSERT into {$table} ($colName) VALUES ($paramMask)";

        $st = $this->conn->prepare($sql);
        foreach ($param as $key => $value) {
            $st->bindValue(":" . $key, $value);
        }
        $st->execute();
        return $this->conn->lastInsertId();
    }

// Brise podatke iz tabele
//@param String $table: tabela iz koje se brisu podaci
//@param String $where: uslov za brisanje kolone iz tabele
    public function delete($table, $where) {
        $this->conn->exec("DELETE from {$table} WHERE {$where}");
    }

// Menja podatke iz tabele
//@param String $table: tabela u kojoj se menjaju podaci
//@param Array $param: kljucevi moraju biti nazvani identicno kao kolone u kojima
//zelimo da menjamo podatke
//@param String $where: uslov za izmenu kolone iz tabele
    public function update($table, $param, $where) {
        $colVal = '';
        foreach ($param as $key => $value) {
            $colVal .= "`" . $key . "` = :" . $key . ",";
        }
        $colVal = rtrim($colVal, ",");
        $sql = "UPDATE {$table} set {$colVal} WHERE {$where}";
        $st = $this->conn->prepare($sql);
        foreach ($param as $key => $value) {
            $st->bindValue(":" . $key, $value);
        }
        $st->execute();
    }

}
