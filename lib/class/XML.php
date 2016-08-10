<?php

	/**
	 * ==============================
	 * XML
	 * ==============================
	 */

	class XML {

		private $xml;
		private $array;
		private $parser;

	    function __construct($data){
		    $this -> parser = xml_parser_create();

	        xml_set_object($this -> parser, $this);
	        xml_set_element_handler($this -> parser, "tag_open", "tag_close");
	        xml_set_character_data_handler($this -> parser, "cdata");


	        if(is_string($data)){
		        $this -> xml = filter_var($data, FILTER_VALIDATE_URL)? $this -> parseUrl($data) : $data;
		        $this -> array = xml_parse($this -> parser, $data);
	        }
	    }

	    public function __toString(){
	        return xml_encode($this -> array, xml_UNESCAPED_SLASHES | xml_UNESCAPED_UNICODE | xml_PRETTY_PRINT);
	    }

	    public function toArray(){
		    return $this -> array;
	    }

	    private function parseUrl($url){
		    $data = file_get_contents($url);
		    if(xml_parse($this -> parser, $data) != null){
			    return $data;
		    }else{
			    throw new RuntimeException("Invalid xml from URL");
		    }
	    }

	    public function get($key){
		    return in_array($key, $this ->array) ? $this ->array[$key]: null;
	    }

	}
?>