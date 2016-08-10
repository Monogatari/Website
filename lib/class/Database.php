<?php

	/**
	 * ==============================
	 * Database
	 * ==============================
	 */

	class Database {

		private $pdo;
		private $host;
		private $pass;
		private $user;
		private $database;

		function __construct($user, $pass, $database, $host = "localhost"){
		    $this -> host = $host;
		    $this -> user = $user;
		    $this -> pass = $pass;
		    $this -> database = $database;
		    $this -> connect();
		}

		public function getPdo(){
		    return $this -> pdo;
		}

		protected function connect(){
		    try{
		        $this -> pdo = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this -> user, $this -> pass);
		    }catch(PDOException $e){
		        die($e);
		    }
		}

		public function query($query, $array = []){
		    if($sth = $this -> pdo -> prepare($query)){
				return $sth -> execute($array) ? $sth -> fetchAll(PDO::FETCH_ASSOC) : null;
		    }else{
		        return null;
		    }
		 }


		public function selectAllWhere($table, $keyname, $key){
			if($sth = $this -> pdo -> prepare("SELECT * FROM `$table` WHERE `$keyname` = ?")){
				return $sth -> execute(array($key)) ? $sth -> fetchAll(PDO::FETCH_ASSOC) : null;
			}
			return null;
		}

		public function selectAllFrom($table){
		    if($sth = $this -> pdo -> prepare("SELECT * FROM `$table`")){
		        return $sth -> execute() ? $sth -> fetchAll(PDO::FETCH_ASSOC) : null;
		    }
		    return null;
		}

		public function exists($table, $keyname, $key){
		    if($sth = $this -> pdo -> prepare("SELECT `$keyname` FROM `$table` WHERE `$keyname`= ?")){
				return $sth -> execute(array($key)) ? $sth -> rowCount() > 0 : false;
		    }
		    return false;
		}

		public function insert($table, $values){
			$fields = "";
			$questionMarks = "";
			$array = array();

			foreach($values as $key => $value){
				$fields .= "`$key`,";
				$questionMarks .= "?,";
				array_push($array, $value);
			}
			$fields = rtrim($fields, ",");
			$questionMarks = rtrim($questionMarks, ",");

			if($sth = $this -> getPdo() -> prepare("INSERT INTO `$table` ($fields) VALUES ($questionMarks)")){

				return $sth -> execute($array);
			}
		}

		public function update($table, $values, $whereField, $whereValue){

			$string = "";
			$array = array();

			foreach($values as $key => $value){
				$string .= "`$key` = ?,";
				array_push($array, $value);
			}

			$string = rtrim($string, ",");

			array_push($array , $whereValue);

			if($sth = $this -> getPdo() -> prepare("UPDATE `$table` SET $string WHERE `$whereField` = ?")){
				return $sth -> execute($array);
			}

		}

		 /**
		  * Delete a Database Entry.
		  *
		  * @access public
		  * @param mixed $table - Table Name
		  * @param mixed $key - Value Key
		  * @param mixed $value - Value
		  * @param mixed $type - Data type
		  * @return void
		  */
		public function delete($table, $keyname, $key){
		    if($sth  = $this -> pdo -> prepare("DELETE FROM `$table` WHERE `$keyname`= ?")){
		       return $sth -> execute(array($key));
		    }
		}

		public function backupTo($dir){
		    $fopen = fopen("$dir/backup_".date('Y-m-d_h_i_s') . '.sql', 'w');

		    fwrite($fopen,"-- Aegis Database Backup \n");
		    fwrite($fopen,"-- Server version:".mysql_get_server_info()."\n");
		    fwrite($fopen,"-- Generated: ".date('Y-m-d h:i:s')."\n");
		    fwrite($fopen,'-- Current PHP version: '.phpversion()."\n");
		    fwrite($fopen,'-- Database:'.$this -> database."\n");

		    $Tables = array();
			$data = $this -> query("SHOW TABLES");

			while($row = $data -> fetch()) {
		    	$Tables[] = $row[0];
			}

			foreach($Tables as $Table){
				fwrite($fopen,"-- ============================== \n");
				fwrite($fopen,"-- Structure for $Table\n");
				fwrite($fopen,"-- ============================== \n\n");

				fwrite($fopen,'DROP TABLE IF EXISTS '.$Table.';');

				if(!$create = $this -> query("SHOW CREATE TABLE $Table")){
					return false;
				}

				$row_create = $create ->fetch(PDO::FETCH_ASSOC);

				fwrite($fopen,"\n".$row_create['Create Table'].";\n");

				fwrite($fopen,"-- ============================== \n");
		        fwrite($fopen,"-- Dump Data for `$Table`\n");
		        fwrite($fopen,"-- ============================== \n\n");

		        if(!$res_select = $this -> query("SELECT * FROM $Table")){
		            return false;
		        }

		        $fields_info = $res_select -> fetch(PDO::FETCH_OBJ);
		        while ($values = $res_select -> fetch(PDO::FETCH_ASSOC)){

		            $Fields = '';
		            $Values = '';
		            foreach ($fields_info as $name => $field) {
		                if ($Fields != ''){
		                	$Fields .= ',';
		                }
		                $Fields .= "`$name`";

		                if(strtolower($name) == "id"){
		                    $field = 0;
		                }

		                if($Values != ''){
		                	$Values .= ',';
		                }

		                $Values .= "'".preg_replace('/[^(\x20-\x7F)\x0A]*/','',str_replace("'","''",$field)."'");

		            }

		            fwrite($fopen,"INSERT INTO $Table ($Fields) VALUES ($Values);\n");
		        }
		        fwrite($fopen,"\n\n\n");

			}
			fclose($fopen);
		}

		public function restore($file){
		    $data = file_get_contents($file);
		    return $this -> query($data);
		}

		public function selectAllByDate($table, $dateField){
		    if($sth = $this -> pdo -> prepare("SELECT * FROM `$table` ORDER BY DATE(`$dateField`) DESC")){
		        return $sth -> execute() ? $sth -> fetchAll(PDO::FETCH_ASSOC) : null;
		    }
		    return null;
		}

		function __destruct() {
		    $this -> pdo = null;
		}

	}
?>