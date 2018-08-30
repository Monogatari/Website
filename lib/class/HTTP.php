<?php

    /**
	 * ==============================
	 * HTTP
	 * ==============================
	 */

    class HTTP {

		public static $contentType;

        /**
         * Set the response type header
         *
         * @param string $type | Content Type
         * @param string $charset | Charset for response (Default: utf-8)
         */
        public static function type ($type = null, $charset = 'utf-8') {

			if ($type !== null) {
				self::$contentType = $type;

				switch($type){
	                case "json":
	                    header("Content-Type: application/json;charset=$charset");
	                    break;

	                case "html":
	                    header("Content-Type: text/html;charset=$charset");
	                    break;
	            }
			} else {
				return self::$contentType;
			}
        }

		public static function allow ($methods) {
			header("Access-Control-Allow-Methods: " . implode(", ", $methods));
		}

		public static function whitelist ($domain) {
			header("Access-Control-Allow-Origin: $domain");
		}

		public static function credentials ($bool) {
			if ($bool) {
				header('Access-Control-Allow-Credentials: true');
			} else {
				header('Access-Control-Allow-Credentials: false');
			}
		}

		public static function debug ($code, $title = "Debugging Log", $description = "Sorry, an error has ocurred.", $message = "An error has ocurred, check the log to see what's going on.", $log = [], $file = null, $line = null) {
			if (Aegis::$debugging) {
				$object = [
					"OS" => PHP_OS,
					"PHP Version" => PHP_VERSION,
					"Aegis Flavor" => Aegis::$flavor,
					"Aegis Version" => Aegis::$version,
					"Message" => $message
				];

				if ($file !== null) {
					$object["File"] = $file;
					$object["Line"] = $line;
				} else {
					$object["File"] = debug_backtrace()[0]["file"];
					$object["Line"] = debug_backtrace()[0]["line"];
				}

				$object = array_merge ($object, $log);
				if (self::$contentType === "json") {
					echo new JSON ($object);
				} else {
					$error = new Template();
		            $error -> setContent(file_get_contents(__DIR__."/../../error/error.html"));

					$error -> data["title"] = $title;
					$error -> data["message"] = $description;

					$error -> data["description"] = "";
					foreach ($object as $key => $value) {
						$error -> data["description"] .= "<p><b>$key:</b> $value</p>";
					}
					$error -> data["description"] = "<div>".$error -> data["description"]."</div>";
					$error -> compile ();
					echo $error;
				}
			}
			die();
		}

        /**
         * Send error response
         *
         * Set the error header to the response and build it's custom error
         * page adding the debug information if it's enabled. After printing
         * the page it dies.
         *
         * @param int $code | HTTP Error Code
         * @param int $number | PHP Error Number
         * @param string $message | Error Description
         * @param string $file | File In Which The Error Is
         * @param int $line | Line Number
         *
         */
        public static function error($code, $number = null, $message = null, $file = null, $line = null) {
			switch($code){
                case 400:
					header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request", true, 400);
					$title = "Bad Request";
					$errorDescription = "The request is invalid.";
					break;
				case 401:
					header($_SERVER["SERVER_PROTOCOL"]." 401 Unauthorized", true, 401);
					$title = "Unauthorized Access";
					$errorDescription = "Autentication is Required.";
					break;
				case 403:
					header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden", true, 403);
					$title = "Forbidden";
					$errorDescription = "Forbidden access, clearance neeeded.";
					break;
				case 404:
					header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
					$title = "Page Not Found";
					$errorDescription = "Sorry, the page you are trying to access does not exist.";
					break;

                case 409:
					header($_SERVER["SERVER_PROTOCOL"]." 409 Conflict", true, 409);
					$title = "Conflict";
					$errorDescription = "A request or file conflict ocurred, please try again.";
					break;

				case 500:
					header($_SERVER["SERVER_PROTOCOL"]." 500 Internal Server Error", true, 500);
					$title = "Server Error";
					$errorDescription = "Sorry, it seems there's been an error. Please try later.";
					break;
			}
			if (Aegis::$debugging) {
				self::debug ($code, $title, $errorDescription, $message, [], $file, $line);
			} else {
				$error = new Template();
				$error -> setContent(file_get_contents(__DIR__."/../../error/$code.html"));
				$error -> compile ();
				echo $error;
			}

        }
    }

?>