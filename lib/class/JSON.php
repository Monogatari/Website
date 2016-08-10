<?php

	/**
	 * ==============================
	 * JSON
	 * ==============================
	 */

	class JSON {

		private $json;
		private $array;

	    function __construct($data){
	        if(is_string($data)){
		        $this -> json = filter_var($data, FILTER_VALIDATE_URL)? $this -> parseUrl($data) : $data;
		        $this -> array = json_decode($this -> json, true);
	        }elseif(is_array($data)){
		        $this -> json = json_encode($data);
		        $this -> array = $data;
	        }
	    }

	    public function __toString(){
	        return json_encode($this -> array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	    }

	    public function toArray(){
		    return $this -> array;
	    }

	    private function parseUrl($url){
		    $data = file_get_contents($url);
		    if(json_decode($data) != null){
			    return $data;
		    }else{
			    throw new RuntimeException("Invalid JSON from URL");
		    }
	    }

	    public function get($key){
		    return in_array($key, $this ->array) ? $this ->array[$key]: null;
	    }

	}
?>