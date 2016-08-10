<?php

	/**
	 * ==============================
	 * Util
	 * ==============================
	 */

	class Util {

		public function getRandomString($length){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}

		public function getContentFrom($url){
			return file_get_contents($url);
		}

	}
?>