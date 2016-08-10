<?php

	/**
	* ==============================
	* Crypt
	* ==============================
	*/

	class Crypt {

		private $key;
		private $iv;
		private $td;

		function __construct($key = ""){
			$this -> td = mcrypt_module_open('rijndael-256', '', 'cbc', '');
			$this -> iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this -> td), MCRYPT_DEV_URANDOM);
			$this -> key = $key;
	    }

	    public function generateKey(){
		    $chars = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?1234567890";
			$key1 = substr(str_shuffle( $chars ), 0, 20 );
			$key2 = substr(str_shuffle( $chars ), 0, 20 );
		    $ks = mcrypt_enc_get_key_size($this -> td);
			$key1 = md5($key1);
		    $key2 = md5($key2);
		    $key = substr($key1, 0, $ks/2) . substr(strtoupper($key2), (round(strlen($key2) / 2)), $ks/2);
		    $key = substr($key.$key1.$key2.strtoupper($key1),0,$ks);
		    return $key;
	    }

	    public function regenerateKey(){
		    $this -> key = $this -> generateKey();
	    }

	    public function setKey($key){
		    $this -> key = $key;
	    }

	    public function getIv(){
		    return $this -> iv;
	    }

	    public function setIv($iv){
		    $this -> iv = $iv;
	    }

		public function getKey(){
			return $this -> key;
		}

		public function encrypt($text){
		    mcrypt_generic_init($this -> td, $this -> key, $this -> iv);
		    $encrypted = mcrypt_generic($this -> td, $text);
		    mcrypt_generic_deinit($this -> td);
		    return $encrypted;
		}

		public function decrypt($text){
		    mcrypt_generic_init($this -> td, $this -> key, $this -> iv);
		    $decrypted = mdecrypt_generic($this -> td, $text);
		    mcrypt_generic_deinit($this -> td);
		    return $decrypted;
		}


		function __destruct(){
			mcrypt_module_close($this -> td);
		}

	}

?>