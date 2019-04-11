<?php

class Model{
//     public function __construct() {
// //@var Object $this->db: instanca klase Database
//        $this->db = Database::getInstance();
//     }


		private static 	$_pdo,
						$_database,
						$_query,
						$_result;
						
		public function __construct(){
			self::$_pdo = Database::getInstance()->conn;
			self::$_database = Database::getInstance();
		}

		public function getDatabase(){
			return self::$_database;
		}


		public function query($sql, $params = array()){
			if(self::$_query = self::$_pdo->prepare($sql)){
				if(!empty($params)){
					$x = 1;
					foreach($params as $param){
						self::$_query->bindValue($x, $param);
						$x++;
					}
				}
				if(self::$_query->execute()){
					self::$_query->setFetchMode(PDO::FETCH_CLASS, static::$className);
					self::$_result = self::$_query->fetchAll();
				}
				return false;
			}
		}

		public function action($action, $where = array()){
			$table = static::$table;
            if(count($where) === 3){
                $operators = array('=', '<', '>', '<=', '>=');
                $field = $where[0];
                $operator = $where[1];
				$value = $where[2];
				//echo $value;die;
                if(in_array($operator, $operators)){
					$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                    return $this->query($sql, array($value));
                }
			}
			if(empty($where)){
				$sql = "{$action} FROM {$table}";
				return $this->query($sql);
			}
        }

		public function getAll($params = array()){
			if(!empty($params)){
				$this->action("SELECT *" , $params);
			}else{
				$this->action("SELECT *");
			}
			return $this->getAllRes();
		}

		public function getOne($id){
			$this->action('SELECT *', array(static::$key, '=', $id));
			return $this->getOneRes();
		}

		public function insert(){
			$arrayObj = (array) $this;
			$tableName = static::$table;
			$tableKey = static::$key;

			$fields = '';
            $values = '';
            $x = 1;
            foreach($arrayObj as $field => $value){
                $fields .= "`".$field."`";
                $values .= "?";
                    if(count($arrayObj) > $x){
                        $fields .= ",";
                        $values .= ",";
                        $x++;
                }      
			}
			$sql = "INSERT INTO {$tableName} ({$fields}) VALUES ({$values})";
			$this->query($sql, $arrayObj);
			$this->$tableKey = self::$_pdo->lastInsertId();
			return $this;
		}

		public function update(){
			$tableName = static::$table;
			$arrayObj = (array) $this;
            $set = '';
            foreach($arrayObj as $field => $value){
                $set .= "`".$field."` = ?,";
            }
            $set = rtrim($set, ",");
			$sql = "UPDATE {$tableName} SET {$set} WHERE id = $this->id";
			$this->query($sql, $arrayObj);
			return $this;
        }

		public function remove($id){
			$tableName = static::$table;
			$tableKey = static::$key;
			$sql = "DELETE FROM {$tableName} WHERE {$tableKey} = ?";
			return $this->query($sql, array($id));
		}

		private function getAllRes(){
			return (count(self::$_result)>1 || empty(self::$_result))? self::$_result: self::$_result[0];
		}

		private function getOneRes(){
			return self::$_result[0];
		}

		public function belongsTo($type){
			$field = 'id_'.strtolower($type);
			$obj = new $type;
			return $obj->getOne($this->$field);
		}

		public function hasMany($type){
			$field = 'id_'.strtolower(get_class($this));
			$obj = new $type;
			return $obj->getAll(array($field, '=', $this->id));
		}
    

}
