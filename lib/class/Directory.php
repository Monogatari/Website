<?php

	/**
	 * ==============================
	 * Directory
	 * ==============================
	 */

	class Directory {

		function __construct($path){

	    }

		public function listFiles(){
			$files = glob("" . $this -> path . "*.*");
			$fl = '';
			// create array
			foreach($files as $file){
				$fl[] = "$file";
			}
			return $fl;
		}

		function __destruct() {

	    }

	}
?>