<?php

	/**
	* ==============================
	* Request
	* ==============================
	*/

	class Request {

		public static function ip () {
			if (!empty ($_SERVER["HTTP_CLIENT_IP"])) {
				//check for ip from share internet
				$ip = $_SERVER["HTTP_CLIENT_IP"];

			} else if (!empty ($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} else {
		        $ip = $_SERVER["REMOTE_ADDR"];
			}

			if (filter_var ($ip, FILTER_VALIDATE_IP)) {
				return $ip;
			} else {
				return null;
			}
		}

		public static function userAgent () {
			if (empty ($_SERVER["HTTP_USER_AGENT"])) {
				return null;
			} else {
				return $_SERVER["HTTP_USER_AGENT"];
			}
		}

		private static function getDataFrom ($method, $keys = null, $allowEmpty = false, $allowHTML = false) {
			if ($_SERVER["REQUEST_METHOD"] != $method && $method != "FILES") {
		        return null;
		    }

			$global = null;

			switch ($method) {
				case "GET":
					$global = $_GET;
					break;

				case "POST":
					if ($_SERVER["CONTENT_TYPE"] == "application/json") {
						$global = json_decode(file_get_contents ("php://input"), true);
					} else {
						$global = $_POST;
					}
					break;

				case "FILES":
					$global = $_FILES;
					break;

				case "PUT":
				case "DELETE":
				case "OPTIONS":
				case "PATCH":
					if ($_SERVER["CONTENT_TYPE"] == "application/json") {
						$global = json_decode(file_get_contents ("php://input"), true);
					} else {
						parse_str (file_get_contents ("php://input"), $global);
					}
					break;
			}

			if ($keys !== null) {
				$array = array ();
    			foreach ($keys as $value) {

    				if (isset ($global[$value])) {
    					if (!$allowEmpty && empty ($global[$value])) {
    						return null;
    					}

                        if (!$allowHTML && $method != "FILES") {
                            $array[$value] = strip_tags ($global[$value]);
                        } else {
                            $array[$value] = $global[$value];
                        }

    				} else {
    					return null;
    				}
    			}
    			return new Collection ($array);
			} else {
				return new Collection ($global);
			}
		}

        /**
         * Get data received from a GET request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function get ($keys = null, $allowEmpty = false, $allowHTML = false) {
		    return self::getDataFrom ('GET', $keys, $allowEmpty, $allowHTML);
		}

		/**
         * Get data received from a POST request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function post ($keys = null, $allowEmpty = false, $allowHTML = false) {
		    return self::getDataFrom ('POST', $keys, $allowEmpty, $allowHTML);
		}

		public static function file ($keys = null, $allowEmpty = false) {
			return self::getDataFrom ('FILES', $keys, $allowEmpty, true);
		}

		/**
         * Get data received from a OPTIONS request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function options ($keys = null, $allowEmpty = false, $allowHTML = false) {
		    return self::getDataFrom ('OPTIONS', $keys, $allowEmpty, $allowHTML);
		}

		/**
         * Get data received from a PUT request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function put ($keys = null, $allowEmpty = false, $allowHTML = false) {
			return self::getDataFrom ('PUT', $keys, $allowEmpty, $allowHTML);
		}

		/**
         * Get data received from a PATCH request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function patch ($keys = null, $allowEmpty = false, $allowHTML = false) {
			return self::getDataFrom ('GET', $keys, $allowEmpty, $allowHTML);
		}

		/**
         * Get data received from a DELETE request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function delete ($keys = null, $allowEmpty = false, $allowHTML = false) {
			return self::getDataFrom ('DELETE', $keys, $allowEmpty, $allowHTML);
		}
	}
?>