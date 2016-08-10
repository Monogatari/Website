<?php

	/**
	 * ==============================
	 * File
	 * ==============================
	 */

	class File {

		private $file;

		function __construct($file){
			$this -> file = $file;
			if(!$this -> exists()){
				$this -> create();
			}
	    }

		public function getSize(){
			return $this -> exists() ? filesize($this -> file) : false;
		}

		public function exists(){
			return file_exists($this -> file);
		}

		public function delete(){
			return $this -> exists() ? unlink($this -> file) : false;
		}

		public function rename($name){
			return $this -> exists() ? rename($this -> file, $name) : false;
		}

		public function create(){
			if(!$this -> exists()){
				$handle = fopen($this -> file, "w");
				fclose($handle);
			}
		}

		public function write($content){
			if($this -> exists()){
				$file = fopen($this -> file, "a");
				fwrite($this -> file, $content);
				fclose($file);
			}
		}

		public function copyTo($path){
			return copy($this -> file, $path);
		}

		public function moveTo($path){
			return $this -> rename($path);
		}

		public function upload($file, $location, $size = 100000000){
			$special = array("#", ":", "ñ", "í", "ó", "ú", "á", "é", "Í", "Ó", "Ú", "Á", "É", " ", "_");
			$common   = array("", "", "n", "i", "o", "u", "a", "e", "I", "O", "U", "A", "E", "-", "-");
	        for($i = 0; $i < count($_FILES[$file]["name"]); $i++){

				if ($_FILES[$file]["size"][$i] > $size) {
				    return false;
				}

				$target_file = $location . str_replace($special, $common, basename($_FILES[$file]["name"][$i]));

				return move_uploaded_file($_FILES[$file]["tmp_name"][$i], $target_file);
			}
		}

		function __destruct() {

	    }

	}
?>