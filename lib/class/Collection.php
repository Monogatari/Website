<?php
	/**
	 * ==============================
	 * Collection
	 * ==============================
	 */

	class Collection implements Iterator {

		private $collection;

		function __construct ($collection = null) {
			if ($collection === null) {
				$this -> collection = array ();
			} else {
				if (is_array ($collection)) {
					$this -> collection = $collection;
				} else if (is_string ($collection)) {
					$this -> collection = json_decode($collection, true);
				} else {
					throw new Exception ("Collection expected an array variable or a JSON object for it's construction, received variable of type: ". gettype ($collection), 1);
				}
			}
		}

		public function object () {
			return $this -> collection;
		}

		public function remove ($index) {
			unset ($this -> collection [$index]);
		}

		public function rewind () {
			reset ($this -> collection);
		}

		public function current () {
			return current ($this -> collection);
		}

		public function key () {
			return key ($this -> collection);
		}

		public function next () {
			return next ($this -> collection);
		}

		public function valid () {
			$key = $this -> key ();
			return $key !== null && $key !== false;
		}

		public function copy () {
			return new Collection ($this -> collection);
		}

		public function hasKey ($key) {
			return array_key_exists ($key, $this -> collection);
		}

		public function keys () {
			return array_keys ($this -> collection);
		}

		public function search ($needle) {
			return array_search ($needle, $this -> collection);
		}

		public function contains ($needle) {
			return in_array ($needle, $this -> collection);
		}

		public function first () {
			return $this -> get (0);
		}

		public function last () {
			return $this -> get ($this -> length () - 1);
		}

		public function get ($index) {
			if ($this -> hasKey ($index)) {
				return $this -> collection[$index];
			} else {
				return null;
			}
		}

		public function set ($index, $value) {
			$this -> collection[$index] = $value;
		}

		public function length () {
			return count ($this -> collection);
		}

		public function all () {
			return $this -> collection;
		}

		public function push () {
			array_push ($this -> collection);
		}

		public function merge ($collection) {
			array_merge($this -> collection, $collection);
		}

		public function prepend ($value) {
			array_unshift($this -> collection, $value);
		}

		public function pop () {
			return array_pop ($this -> collection);
		}

		function json () {
			return json_encode($this -> collection, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		}

		function __toString () {
			return $this -> json ();
		}

		function __destroy () {
			$this -> collection = null;
		}

	}

?>