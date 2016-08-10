<?php

	/**
	 * ==============================
	 * Validator
	 * ==============================
	 */

	class Validator {

		function __construct(){

	    }

		public function validateType($item, $type){
			switch($type){
				case "int":
					return is_int($item);
					break;

				case "float":
					return is_int($item);
					break;

				case "double":
					return is_int($item);
					break;

				case "number":
					return is_numeric($item);
					break;

				case "array":
					return is_array($item);
					break;

				case "boolean":
					return is_bool($item);
					break;

				case "string":
					return is_string($item);
					break;

				case "null":
					return is_null($item);
					break;

				case "empty":
					return empty($item);
					break;

				default:
					return false;
					break;
			}
		}

		public function validateMail($mail){
			if(($mail = filter_var($mail, FILTER_SANITIZE_EMAIL))){
			    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
				    return $mail;
			    }
		    }
		    return false;
		}

		public function secureData($data, $allow_html, $allow_blank){
			$flag = 0;

			if(!$allow_blank && trim($data) == ""){
				$flag += 1;
			}

			$original_data = $data;
			$data = strtolower($data);

			// Block injection codes

			$warnings = array_merge($spam, $injections);


			foreach ($warnings as $i){

				if (strpos($data, $i) !== false){
						return false;
				}
			}

			if ($flag != 0){
				return false;
			}else{
				return $allow_html ? trim($original_data) : strip_tags(trim($original_data));

			}

		}
	}
?>