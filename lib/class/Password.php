<?php

	/**
	 * ==============================
	 * Password
	 * ==============================
	 */

	class Password {

		private $password;
		private $hash;

		function __construct($password = ""){
			$this -> password = $password;
			if($password != ""){
				$this -> hash();
			}
	    }

		/**
		 * Generates a Random Secure Password.
		 *
		 * @access public
		 * @param int $length (default: 8)
		 * @return string
		 */
		public function generate($length = 8){
			$chars = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?1234567890";
			$this -> password = substr(str_shuffle($chars), 0, $length);
			$this -> hash();
		}

		/**
		 * Check Password Strenght.
		 *
		 * @access public
		 * @param mixed $password
		 * @return integer | boolean
		 */
		public function getStrenght(){
			$strenght = 0;

			if(strlen($this -> password > 5)){
				$strenght += 1;
			}

			if(preg_match('/[A-Z]/', $this -> password)){
				$strenght += 1;
			}

			if(preg_match('/[a-z]/', $this -> password)){
				$strenght += 1;
			}

			if(preg_match('/[0-9]/', $this -> password)){
				$strenght += 1;
			}

			return $strenght;
		}

		private function hash(){
			$this -> hash = password_hash($this -> password, PASSWORD_DEFAULT, $this -> getCost());
		}

		/**
		 * Hash given password with the Default Algorithm.
		 *
		 * The Data Base store should be at least of a 255 lenght
		 *
		 * @access public
		 * @param mixed $password
		 * @return string
		 */
		public function getHash(){
			return $this -> hash;
		}

		/**
		 * Check if given password matches the hash.
		 *
		 * @access public
		 * @param mixed $password
		 * @param mixed $hash
		 * @return boolean
		 */
		public function compare($password){
			return password_verify($password, $this -> hash);
		}

	    /**
	     * Get Computational Cost for hashing Passwords.
	     *
	     * A 10 is a Standard
	     *
	     * @access private
	     * @return array - Associative array with the cost.
	     */
	    private function getCost(){
	        $timeTarget = 0.2;

			$cost = 9;
			do {
				$cost++;
				$start = microtime(true);
				password_hash("test", PASSWORD_DEFAULT, ["cost" => $cost]);
				$end = microtime(true);
			}while(($end - $start) < $timeTarget);

	       return ["cost" => $cost];
	    }
	}
?>