<?php

	/**
	 * ==============================
	 * Query
	 * ==============================
	 */

	class Query {

		private $object;
		private $query;
		private $bindings;
		private $results;

		function __construct ($query = "", $bindings = [], $results = []) {
			$this -> query = $query;
			$this -> bindings = $bindings;
			$this -> results = new Collection ($results);
		}

		public function object () {
			return $this -> object;
		}

		public function results () {
			return $this -> results;
		}

		private function append ($command, $data = [], $bind = true, $ticks = true) {
			$this -> query .= $command . " ";

			if ($bind === true) {
				if (is_string ($data) || is_numeric ($data)) {
					$this -> query .= "?";
					array_push ($this -> bindings, $data);
				} else if (is_array ($data)) {
					if (count ($data) > 0) {
						foreach ($data as $d) {
							$this -> query .= "?, ";
							array_push ($this -> bindings, $d);
						}
					}
				}
			} else {
				if (is_string ($data) || is_numeric ($data)) {
					if ($ticks) {
						$this -> query .= "`$data`";
					} else {
						$this -> query .= "$data";
					}

				} else if (is_array ($data)) {
					if (count ($data) > 0) {
						foreach ($data as $d) {
							if ($ticks) {
								$this -> query .= "`$d`, ";
							} else {
								$this -> query .= "$d, ";
							}
						}
					}
				}
			}


			$this -> query = rtrim ($this -> query, ", "). " ";
			return $this;
		}

		public function insert () {
			return $this -> append ("INSERT");
		}

		public function into ($table) {
			return $this -> append ("INTO", $table, false);
		}

		public function values ($values) {
			$this -> append ("(", array_keys ($values), false);
			$this -> append (") VALUES");
			$this -> append ("(", array_values ($values));
			return $this -> append (")");
		}

		public function update ($table) {
			return $this -> append ("UPDATE", $table, false);
		}

		public function set ($values) {
			$this -> append ("SET");
			foreach ($values as $key => $value) {
				$this -> query .= "`$key`=?, ";
				array_push ($this -> bindings, $value);
			}
			$this -> query = rtrim ($this -> query, ", "). " ";
			return $this;
		}

		public function subQuery ($query) {
			return $this -> append ("(" + strval ($query) + ")", false, false);
		}

		public function delete () {
			return $this -> append ("DELETE");
		}

		public function not () {
			return $this -> append ("NOT");
		}

		public function between ($firstData, $secondData) {
			$this -> append ("BETWEEN", $firstData);
			$this -> and ();
			return $this -> append ("", $secondData, true, false);
		}

		public function show () {
			return $this -> query;
		}

		public function select ($data) {
			return $this -> append ("SELECT", $data, false);
		}

		public function as ($data) {
			return $this -> append ("AS", $data, false);
		}

		public function from ($data) {
			return $this -> append ("FROM", $data, false);
		}

		public function where ($data) {
			return $this -> append ("WHERE", $data, false);
		}

		public function bind ($data) {
			$this -> append ("", $data);
		}

		public function and ($data = null) {
			if ($data !== null) {
				return $this -> append ("AND", $data, false);
			} else {
				return $this -> append ("AND");
			}
		}

		public function or ($data) {
			return $this -> append ("OR", $data, false);
		}

		public function like ($data) {
			return $this -> append ("LIKE", "'$data'", false, false);
		}

		public function equals ($data) {
			return $this -> append ("=", $data);
		}

		public function notEquals ($data) {
			return $this -> append ("<>", $data);
		}

		public function lessThan ($data) {
			if (is_string ($data)) {
				return $this -> append ("<", $data, false);
			} else {
				return $this -> append ("<", $data);
			}
		}

		public function moreThan ($data) {
			if (is_string ($data)) {
				return $this -> append (">", $data, false);
			} else {
				return $this -> append (">", $data);
			}
		}

		public function lessOrEqualThan ($data = null) {
			if ($data !== null) {
				return $this -> append ("<=", $data);
			} else {
				return $this -> append ("<=");
			}
		}

		public function moreOrEqualThan ($data = null) {
			if ($data !== null) {
				return $this -> append (">=", $data);
			} else {
				return $this -> append (">=");
			}
		}

		public function limit ($data) {
			return $this -> append ("LIMIT", $data);
		}

		public function date ($data) {
			$this -> append ("DATE(", $data, false);
			return $this -> append (")");
		}

		public function now () {
			return $this -> append ("NOW()");
		}

		public function orderBy ($data) {
			$first = true;
			foreach ($data as $value) {
				if (is_array ($value)) {
					if ($value[1] === "DESC" || $value[1] === "ASC") {
						if ($first === true) {
							$this -> append ("ORDER BY", $value[0], false);
							$first = false;
						} else {
							$this -> append (",", $value[0], false);
						}
						$this -> append ("{$value[1]}");
					} else {
						continue;
					}
				} else {
					continue;
				}
			}
			return $this;
		}

		public function commit () {
			$sth = DB::query ($this -> query, $this -> bindings);
			$this -> object = $sth;
			$this -> results = new Collection ($sth -> fetchAll (PDO::FETCH_ASSOC));
			return $this;
		}

		function __toString () {
			return trim ($this -> query) . ";";
		}

		function __destruct () {
		    $this -> object = null;
			$this -> results = null;
		}
	}
?>