<?php

	/**
	 * ==============================
	 * Text
	 * ==============================
	 */

	class Text {

	    public static function capitalize($text){
		  return ucwords(strtolower($text));
	    }

		public static function checkSimilarity($text1, $text2){
		  similar_text($text1, $text2, $percent);
		  return  $percent;
	    }

	    public static function getSuffix($text, $key){
	        $suffix = "";
	        $position = strpos($text, $key);
	        if($position !== false){
	            $position += strlen($key);
	            $suffix = substr($text, $position, strlen($text) - $position);
	        }
	        return $suffix;
	    }

	    public static function getPrefix($text, $key){
	        return strpos($text, $key) !== false ? substr($text, 0, $position) : "";
	    }

	    public static function getAffixes($text, $key){
	        return [Text::getPrefix($string, $key), Text::getSuffix($string, $key)];
	    }

	    public static function getStringBetween($string, $start, $end){
	        $string = " ".$string;
	        $ini = strpos($string, $start);
	        if($ini == 0){
		        return "";
		    }else{
			    $ini += strlen($start);
				$len = strpos($string, $end, $ini) - $ini;
				return substr($string, $ini, $len);
		    }
	    }

	    public static function removeTags($text){
		    return strip_tags($text);
	    }

	    public static function removeSpecialCharacters($text){
			$special = array("#",":","ñ","í","ó","ú","á","é","Í","Ó","Ú","Á","É","(",")","¡","¿","/");
	        $common   = array("","","n","i","o","u","a","e","I","O","U","A","E","","","","","");
	        return str_replace($special,$common,$text);
	    }

	    public static function removePunctuation($text){
			$special = array(";",",",".");
	        $common   = array("","","");
	        return str_replace($special, $common, $text);
	    }

	    public static function toFriendlyUrl($text){
			$expressions = [
				'[áàâãªä]'   =>   'a',
		        '[ÁÀÂÃÄ]'    =>   'A',
		        '[ÍÌÎÏ]'     =>   'I',
		        '[íìîï]'     =>   'i',
		        '[éèêë]'     =>   'e',
		        '[ÉÈÊË]'     =>   'E',
		        '[óòôõºö]'   =>   'o',
		        '[ÓÒÔÕÖ]'    =>   'O',
		        '[úùûü]'     =>   'u',
		        '[ÚÙÛÜ]'     =>   'U',
		        'ç'          =>   'c',
		        'Ç'          =>   'C',
		        'ñ'          =>   'n',
		        'Ñ'          =>   'N',
		        '_'          =>   '-',
		        '[’‘‹›<>\']' =>   '',
		        '[“”«»„\"]'  =>   '',
		        '[\(\)\{\}\[\]]' => '',
		        '[?¿!¡#$%&^*´`~\/°\|]' => '',
		        '[,.:;]'     => '',
		        '\s'         =>   '-'
		    ];

			foreach($expressions as $regex => $replacement){
				$text = preg_replace("/$regex/u", $replacement, $text);
			}

			return $text;
	    }

	}
?>