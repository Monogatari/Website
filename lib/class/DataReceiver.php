<?php

	/**
	* ==============================
	* Data Receiver
	* ==============================
	*/

	class DataReceiver {

	    public function receive($method, $keys, $allowHTML = false, $allowEmpty = false){
			$keys = explode(",", $keys);
			$array = array();

			$method = ($method == "post" || $method == "POST") ? $_POST : $_GET;

			foreach($keys as $value){
				if(isset($method[$value])){

					if(!$allowEmpty && empty($method[$value])){
						return false;
					}

					$array[$value] = $allowHTML ? $method[$value] : strip_tags($method[$value]);

				}elseif(isset($_FILES[$value])){
					
					if(!$allowEmpty && empty($_FILES[$value])){
						return false;
					}

					$array[$value] = $_FILES[$value];

				}else{
					return false;
				}
			}
			return $array;
		}
	}
?>