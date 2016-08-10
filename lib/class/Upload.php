<?php

	/**
	* ==============================
	* Upload
	* ==============================
	*/

	class Upload {

		private $file;
		private $maxSize;
		private $forbiddenCharacters;
		private $allowesCharacters;
		private $allowedExtencions;

		function __construct($file, $path, $maxSize = 50000000){
            $this -> allowedExtensions = [
        		"images" => ["gif", "jpeg", "jpg", "png"],
        		"files" => ["pdf", "docx", "ppt", "txt", "zip", "rar"]
        	];
        	$this -> file = $_FILES[$file];
        	$this -> path = $path;
            $this -> maxSize = $maxSize;
            $this -> forbiddenCharacters = array("#", ":", "ñ", "í", "ó", "ú", "á", "é", "Í", "Ó", "Ú", "Á", "É", " ", "_");
            $this -> allowedCharacters = array("", "", "n", "i", "o", "u", "a", "e", "I", "O", "U", "A", "E", "-", "-");
        }

        public function isEmpty(){
	        return empty($this -> file);
        }


        private function isImage($index = ""){
	        if($index === ""){
		        $name = explode(".", $this -> file["name"]);
		        $extension = end($name);
		        return in_array($extension,  $this -> allowedExtensions["images"])
					&& (($this -> file["type"] == "image/gif")
	                 || ($this -> file["type"] == "image/jpeg")
	                 || ($this -> file["type"] == "image/jpg")
	                 || ($this -> file["type"] == "image/pjpeg")
	                 || ($this -> file["type"] == "image/x-png")
	                 || ($this -> file["type"] == "image/png"));
	        }else{
		        $name = explode(".", $this -> file["name"][$index]);
		        $extension = end($name);
				return in_array($extension,  $this -> allowedExtensions["images"])
				&& (($this -> file["type"][$index] == "image/gif")
                 || ($this -> file["type"][$index] == "image/jpeg")
                 || ($this -> file["type"][$index] == "image/jpg")
                 || ($this -> file["type"][$index] == "image/pjpeg")
                 || ($this -> file["type"][$index] == "image/x-png")
                 || ($this -> file["type"][$index] == "image/png"));
	        }

        }

        private function isFile($index = ""){
	        if($index === ""){
		        $name = explode(".", $this -> file["name"]);
		        $extension = end($name);
				return in_array($extension,  $this -> allowedExtensions["files"]);
	        }else{
		        $name = explode(".", $this -> file["name"][$index]);
		        $extension = end($name);
				return in_array($extension,  $this -> allowedExtensions["files"]);
	        }

        }

        private function validate($index = ""){
	        if($index === ""){
		         if ($this -> file["error"] > 0 || $this -> file["size"] > $this -> maxSize){
					return false;
				}

				return $this -> isImage() || $this -> isFile();
	        }else{
		        if ($this -> file["error"][$index] > 0 || $this -> file["size"][$index] > $this -> maxSize){
					return false;
				}
				return $this -> isImage($index) || $this -> isFile($index);
	        }

        }

        public function rename($newName){
	        $this -> file["name"] = str_replace($this -> forbiddenCharacters, $this -> allowedCharacters, $newName);
        }

        private function fixOrientation($file){
	        if(exif_imagetype($file) == 2){
                $exif = exif_read_data($file);
            	if(array_key_exists('Orientation', $exif)){
                	$orientation = $exif['Orientation'];
                    $images_orig = ImageCreateFromJPEG($file);
                    $rotate = "";
					switch ($orientation) {
					   case 3:
					      $rotate = imagerotate($images_orig, 180, 0);
					      break;
					   case 6:
					      $rotate = imagerotate($images_orig, -90, 0);
					      break;
					   case 8:
					      $rotate = imagerotate($images_orig, 90, 0);
					      break;
					}
					if($rotate != ""){
	                    ImageJPEG($rotate, $file);
	                    ImageDestroy($rotate);
					}
					ImageDestroy($images_orig);
            	}
            }
        }

        public function upload(){
			$this -> file["name"] = str_replace($this -> forbiddenCharacters, $this -> allowedCharacters, $this -> file["name"]);
			$name = explode(".", $this -> file["name"]);
			$extension = end($name);
			if($this -> validate()){
				$location = $this -> path.$this -> file["name"];
                move_uploaded_file($this -> file["tmp_name"], $location);
                if($this -> file["type"] == "image/jpeg" || $this -> file["type"] == "image/jpg"){
	                $this -> fixOrientation($location);
                }
                return $location;
			}
        }

        public function uploadAll(){
	        $files = array();
	        print_r($this -> file);
			for($i = 0; $i < count($this -> file["name"]); $i++){
				echo $i;
				if($this -> validate($i)){
					$final_name = str_replace($this -> forbiddenCharacters, $this -> allowedCharacters, $this -> file["name"][$i]);
					$final_name_array = explode(".", $final_name);
			    	$extension = end($final_name_array);
			    	$location = $this -> path.$final_name;
			    	move_uploaded_file($this -> file["tmp_name"][$i], $location);
					if($this -> file["type"][$i] == "image/jpeg" || $this -> file["type"][$i] == "image/jpg"){
	                	$this -> fixOrientation($location);
                	}
					array_push($files, $location);
				}else{
					continue;
				}

			}
			return $files;
        }

 	}
?>