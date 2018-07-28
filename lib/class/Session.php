<?php

	/**
	 * ==============================
	 * Session
	 * ==============================
	 */

	class Session {

		private static $id;
		private static $meta;

		public static function start () {
			session_set_cookie_params(365 * 24 * 60 * 60);

			ini_set ('session.gc_maxlifetime', 3600);

			session_start ();

			session_regenerate_id ();

			if (!isset($_SESSION['active'])) {
		    	$_SESSION['active'] = false;
			}
		}

		/**
		 * Regenerate session's id.
		 *
		 * @access public
		 * @return void
		 */
		public static function regenerate () {
			session_regenerate_id (true);
		}

		/**
		 * End and destroy the session, it's variables and cookie.
		 *
		 * @access public
		 * @return void
		 */
		public static function end () {
			unset ($_SESSION);
			session_unset ();
			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params ();
				setcookie (session_name (), "", time () - (365 * 24 * 60 * 60), $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			}
			session_destroy ();
		}

		public static function __callStatic ($name, $arguments) {
			if (count ($arguments) > 0) {
				 $_SESSION[$name] = $arguments[0];
			} else {
				if (array_key_exists ($name, $_SESSION)) {
					return $_SESSION[$name];
				} else {
					throw new Exception("Session property '$name' does not exist.", 1);
				}
			}
		}

	}
?>