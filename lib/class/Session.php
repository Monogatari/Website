<?php
/**
 * ==============================
 * Session
 * ==============================
 */

/**
 * Session class. - Controlls User Session
 *
 * @extends Security
 */
class Session extends Visitor {

	private $id;
	private $meta;

	function __construct(){
		session_set_cookie_params(365 * 24 * 60 * 60);

		ini_set('session.gc_maxlifetime', 3600);

		session_start();

		session_regenerate_id();

		$meta = $_SESSION["meta"] = ["IP" => $this -> getIP(), "UserAgent" => $this -> getUserAgent()];

		if(!isset($_SESSION['active'])){
	    	$_SESSION['active'] = false;
		}
	}

	/**
	 * Regenerate session's id.
	 *
	 * @access public
	 * @return void
	 */
	public function regenerate(){
		session_regenerate_id(true);
	}


	/**
	 * End and destroy the session, it's variables and cookie.
	 *
	 * @access public
	 * @return void
	 */
	public function end(){
		unset($_SESSION);
		session_unset();
		if(ini_get("session.use_cookies")){
			$params = session_get_cookie_params();
			setcookie(session_name(), "", time() - (365 * 24 * 60 * 60), $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
		session_destroy();

	}

	/**
	 * Check if User meta-data is still the same.
	 *
	 * @access public
	 * @param mixed $meta - Associative array with Ip and User Agent
	 * @return boolean
	 */
	public function check($meta){
		if($this -> getIP() == $_SESSION["ip"] && $this -> getUserAgent() == $_SESSION["agent"]){
			return true;
		}else{
			$this -> close();
		}
		return false;
	}

	public function set($key, $value){
		$_SESSION[$key] = $value;
	}

	public function get($key){
		if(array_key_exists($key, $_SESSION)){
			return $_SESSION[$key];
		}else{
			return null;
		}
	}

}
?>