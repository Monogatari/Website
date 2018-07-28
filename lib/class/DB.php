<?php

	/**
	 * ==============================
	 * Database
	 * ==============================
	 */

	class DB {

		private static $charset;
		private static $database;
		private static $host;
		private static $pass;
		private static $connection;
		private static $user;

		public static function connect ($user, $pass, $database, $host = "localhost", $charset = "utf8"){
			try {
				self::$host = $host;
			    self::$user = $user;
			    self::$pass = $pass;
			    self::$database = $database;
				self::$charset = $charset;
			    self::$connection = new PDO("mysql:host=$host;dbname=$database;charset=$charset", $user, $pass);

				Component::initialize ();

			} catch (PDOException $e) {
				throw new Exception("Connection failed, check your credentials and user permissions.", 1);
			}
		}

		public static function isEmpty () {
			$count = self::query ("SELECT COUNT(DISTINCT `table_name`) AS `tables` FROM `information_schema`.`columns` WHERE `table_schema` = '" . self::$database . "'") -> fetchAll (PDO::FETCH_ASSOC)[0]["tables"];
			return intval ($count) == 0;
		}

		public static function connection () {
		    return self::$connection;
		}

		public static function last () {
			return self::$connection -> lastInsertId();
		}

		public static function name () {
			return self::$database;
		}

		private static function prepare ($query) {
			$sth = self::connection () -> prepare($query);
			if ($sth) {
				return $sth;
			} else {
				throw new Exception("Error preparing query.<p><b>Query:</b> " . $sth -> queryString . "</p><p><b>Database Error:</b> ". $sth -> errorInfo ()[2]. "</p>", 1);
			}
		}

		private static function execute (&$sth, $array) {
			if (!$sth -> execute($array)) {
				throw new Exception("Error executing query.<p><b>Query: </b>" . $sth -> queryString. "</p><p><b>Database Error:</b> ". $sth -> errorInfo ()[2]. "</p>", 1);
			}
		}

		public static function query ($query, $array = []){
			$sth = self::prepare ($query);
			self::execute ($sth, $array);
			return $sth;
		 }

		 public static function attribute ($attribute) {
			 return self::connection () -> getAttribute($attribute);
		 }

		public static function backup ($directory) {
			$fopen = fopen("$dir/backup_".date('Y-m-d_h_i_s') . '.sql', 'w');

			fwrite($fopen,"-- Aegis Database Backup \n");
			fwrite($fopen,"-- Server version: ".self::attribute (PDO::ATTR_SERVER_VERSION)."\n");
			fwrite($fopen,"-- Generated: ".date('Y-m-d h:i:s')."\n");
			fwrite($fopen,'-- Current PHP version: '.phpversion()."\n");
			fwrite($fopen,'-- Database: '.self::name()."\n");

			/*$Tables = array();
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

			$Values .= "'".preg_replace('/[^(\x20-\x7F)\x0A]*\/','',str_replace("'","''",$field)."'");

			}

			fwrite($fopen,"INSERT INTO $Table ($Fields) VALUES ($Values);\n");
			}
			fwrite($fopen,"\n\n\n");

			}
			fclose($fopen);*/
		}

		function __destruct() {
		    self::$connection = null;
		}
	}

?>