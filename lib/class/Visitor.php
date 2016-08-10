<?php
/**
 * ==============================
 * Visitor
 * ==============================
 */
class Visitor {

	function __construct(){

    }

    /**
	 * Get User's real IP even if it's using a Proxy.
	 *
	 * @access public
	 * @return string | boolean - returns Ip if it's valid or false if it's invalid.
	 */
	public static function getIP(){
		if (!empty($_SERVER["HTTP_CLIENT_IP"])){
			//check for ip from share internet
			$ip = $_SERVER["HTTP_CLIENT_IP"];

		}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			// Check for the Proxy User
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else{
            $ip = $_SERVER["REMOTE_ADDR"];
		}
		return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : null;
	}

	public static function getUserAgent(){
		if(empty($_SERVER['HTTP_USER_AGENT'])){
			return "";
		}else{
			return $_SERVER['HTTP_USER_AGENT'];
		}
	}

	public function validateType($item,$type){
		switch($type){
			case "int":
				if(is_int($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "float":
				if(is_int($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "double":
				if(is_int($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "numeric":
				if(is_numeric($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "array":
				if(is_array($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "boolean":
				if(is_bool($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "string":
				if(is_string($item)){
					return true;
				}else{
					return false;
				}
			break;
			case "null":
				if (is_null($item)){
					return true;
				}

			break;
			case "empty":
				if (empty($item)){
					return true;
				}

			break;
			default:
				return false;
			break;
		}

	}


	public function secureData($data, $allow_html, $allow_blank){
		$flag = 0;

		if(!$allow_blank && trim($data) == ""){
			$flag += 1;
		}

		$original_data=$data;
		$data=strtolower($data);

		// Block injection codes
		$injections = array("content-type:","mime-version:","content-transfer-encoding:","return-path:","subject:","from:",
						"envelope-to:","to:","bbc:","cc:","gzinflate(","eval(","base64_decode(","../","..\\",
						"select ","update ","insert into ","gzinflate","eval ","base64_decode","<?php","<script",
						"<?","<%","?>", "union select","a%","[url=]","[link=]","truncate ","drop from ");

		//Block common Spam URLS and words
		$spam = array("downloadlump","downloadcalm","downloadgive","downloadanti","webpaulo","downloaddry",
										"crabshare","downloadhurt","downloadlazy","peopleofthebook","vtwfoiauon","rursuasia");

		$warnings = array_merge($spam, $injections);


		foreach ($warnings as $i){

			if (strpos($data,$i) !== false){
					$flag += 1;
			}
		}

		if ($flag != 0){
			return false;
		}else{
				if($allow_html){
					return trim($original_data);
				}else{
					return strip_tags(trim($original_data));
				}


		}

	}

}
?>