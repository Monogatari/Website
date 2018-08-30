<?php

	/**
	 * ==============================
	 * Password
	 * ==============================
	 */

	class Password {

		/**
		 * Generates a Random Secure Password.
		 *
		 * @access public
		 *
		 * @param int $length (default: 8)
		 *
		 * @return string | Randomly Generated Password.
		 */
		public static function generate($length = 8){
			$chars = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?1234567890";
			return substr(str_shuffle($chars), 0, $length);
		}

		/**
		 * Hash a password using the default algorithm
		 *
		 * @access public
		 *
		 * @param string $password | Password To Hash
		 *
		 * @return string | Hashed Password
		 */
		public static function hash($password){
			return password_hash($password, PASSWORD_DEFAULT, self::getCost());
		}

		/**
		 * Check if given password matches a hash.
		 *
		 * @access public
		 *
		 * @param string $password | Password To Compare
		 * @param string $hash | Hash To Compare Password Against
		 *
		 * @return boolean
		 */
		public static function compare($password, $hash){
			return password_verify($password, $hash);
		}

	    /**
	     * Get Computational Cost to Hash Passwords.
	     *
	     * The function hashes a test password multiple time until it gets
	     * the best cost in matter of time and security. This cost depends
	     * greatly on the machine it's running.
	     *
	     * A 10 is a Standard
	     *
	     * @access private
	     *
	     * @return array | Associative Array With The Cost.
	     */
	    private static function getCost(){
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