<?php

	/**
	* ==============================
	* Schema
	* ==============================
	*/

	class Schema {

		private static $tables = [];

		// Schema Information
		public $charset;
		public $collation;
		public $engine;
		private $constrains;
		private $properties;

		// Table Information
		public $name;

		function __construct ($name, $engine, $charset, $collation) {
			$this -> properties = [];
			$this -> constrains = [];
			$this -> name = $name;
			$this -> charset = $charset;
			$this -> collation = $collation;
			$this -> engine = $engine;
			$this -> foreigns = [];

			self::$tables[$name] = [
				'constrains' => []
			];
		}

		public function properties () {
			return new Collection ($this -> properties);
		}

		public static function create ($name, $engine = "InnoDB", $charset = "utf8", $collation = "utf8_bin") {
			return new Schema ($name, $engine, $charset, $collation);
		}

		function __toString () {
			return "CREATE TABLE IF NOT EXISTS `".DB::name()."`.`{$this -> name}` ({$this -> buildProperties()} {$this -> buildConstrains()}) ENGINE={$this -> engine} CHARSET={$this -> charset} COLLATE={$this -> collation};";
		}

		public function fields () {
			return array_keys ($this -> properties);
		}

		public function hasField ($field) {
			return in_array ($field, array_keys ($this -> properties));
		}

		private function buildProperties () {
			$query = "";
			foreach ($this -> properties as $name => $value) {
				$query .= "`$name` ";
				foreach ($value as $rule) {
					$query .= "$rule ";
				}
				$query .= ",";
			}
			return rtrim($query, ",");
		}

		private function buildConstrains () {
			$query = "";
			if (count ($this -> constrains) > 0) {
				$query = ",";
				foreach ($this -> constrains as $value) {
					$query .= "$value,";
				}

			}
			return rtrim($query, ",");
		}

		private function addRule ($name, $rule) {
			if (!array_key_exists($name, $this -> properties)) {
				$this -> properties[$name] = [];
			}

			if (!in_array($rule, $this -> properties[$name])) {
				array_push ($this -> properties[$name], $rule);
			}
			return $this;
		}

		public function addConstrain ($constrain) {
			if (!in_array($constrain, $this -> constrains)) {
				array_push ($this -> constrains, $constrain);
			}
			return $this;
		}

		public function default ($name, $value) {
			return $this -> addRule ($name, "DEFAULT $value");
		}

		public function string ($name, $size) {
			return $this -> addRule ($name, "VARCHAR($size)");
		}

		public function bigInt ($name, $size) {
			return $this -> addRule ($name, "BIGINT($size)");
		}

		public function text ($name, $size = 65535) {
			return $this -> addRule ($name, "TEXT($size)");
		}

		public function int ($name, $size) {
			return $this -> addRule ($name, "INT($size)");
		}

		public function decimal ($name, $size) {
			return $this -> addRule ($name, "DECIMAL($size)");
		}

		public function float ($name, $size) {
			return $this -> addRule ($name, "FLOAT($size)");
		}

		public function date ($name) {
			return $this -> addRule ($name, "DATE");
		}

		public function dateTime ($name) {
			return $this -> addRule ($name, "DATETIME");
		}

		public function time ($name) {
			return $this -> addRule ($name, "TIME");
		}

		public function boolean ($name) {
			return $this -> addRule ($name, "BOOLEAN");
		}

		public function null ($name) {
			return $this -> addRule ($name, "NULL");
		}

		public function notNull ($name) {
			return $this -> addRule ($name, "NOT NULL");
		}

		public function primary ($name) {
			$this -> id = $name;
			return $this -> addRule ($name, "PRIMARY KEY");
		}

		public function unique ($name) {
			return $this -> addRule ($name, "UNIQUE");
		}

		public function increment ($name) {
			return $this -> addRule ($name, "AUTO_INCREMENT");
		}

		public function index ($name) {
			return $this -> addRule ($name, "INDEX");
		}

		public function foreign ($name, $table, $property, $update = "CASCADE", $delete = "RESTRICT") {
			$this -> foreigns[$name] = $table;
			$constrain_name = "FK_".$this -> name."_$table";
			return $this -> addConstrain ("CONSTRAINT `$constrain_name` FOREIGN KEY (`$name`) REFERENCES `".DB::name()."`.`$table`(`$property`) ON UPDATE $update ON DELETE $delete");
			array_push (self::$tables[$this -> $name]["constrains"], $constrain_name);
		}

		public static function createConstraints () {
			
		}

		public static function dropConstraints ($table = null) {
			if ($table !== null) {
				$constrains = self::$tables[$table]['constrains'];
				foreach ($constrains as $constrain) {
					DB::query ("ALTER `$table` DROP CONSTRAINT `$constrain`");
				}
			} else {
				foreach (self::$tables as $table => $value) {
					echo $table;
					print_r ($value);
					$constrains = $value['constrains'];
					foreach ($constrains as $constrain) {
						DB::query ("ALTER `$table` DROP CONSTRAINT `$constrain`");
					}
				}
			}
		}

		public static function tables () {
			return self::$tables;
		}

		public static function exists ($name) {
			try {
				DB::query ("SELECT 1 FROM `" . $name::schema () -> name . "` LIMIT 1;");
			} catch (Exception $e) {
				return false;
			}
			return true;
		}

		public static function drop ($name = null) {
			if ($name !== null) {
				DB::query ("DROP TABLE IF EXISTS `$name`");
			} else {
				self::dropConstraints ();
				foreach (self::$tables as $table => $value) {
					DB::query ("DROP TABLE IF EXISTS `$table`");
				}
			}
		}

		public static function truncate ($name) {
			DB::query("TRUNCATE TABLE `$name`");
		}

		public static function commit ($schema = null) {
			if ($schema !== null) {
				DB::query ($schema);
			}
		}

		public static function setup ($clean = false) {
			if ($clean === true) {
				Schema::drop ();
			}
			Component::commit ();
		}
	}

?>