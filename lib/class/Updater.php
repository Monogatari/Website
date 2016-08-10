<?php

	/**
	 * ==============================
	 * Updater
	 * ==============================
	 */

	class Updater {

		private $url;
		private $version;
		private $details;

	    function __construct($version, $url){
	        $this -> url = $url;
	        $this -> version = intval(str_replace(".", "", $version));
	        $this -> details = $this -> getInformation();
	    }

	    public function getDetails(){
	        return $this -> details;
	    }

	    private function getInformation(){
	        $data = new JSON($this -> url);
	        $update = array();
	        foreach($data -> toArray() as $i){
		        $version = intval(str_replace(".", "", $i["Version"]));
	            if($version > $this -> version){
		            $this -> version = $version;
	                $update = $i;
	            }
	        }
	        return count($update) > 0 ? $update : null;
	    }

	    public function install($path = "./"){
		    if($this -> details != null && is_writable($path)){

				if(copy($this -> details["Route"], $path.$this -> details["File"])){
		            if($this -> details["Hash"] == md5_file($this -> details["File"])){
		                $zip = new ZipArchive();
		                if ($zip->setPassword("MySecretPassword")){
			                if($zip -> open($data["File"]) === true){
			                    $zip -> extractTo($path);
			                    $zip -> close();
			                    unlink($data["File"]);
			                    return true;
			                }else{
			                    return false;
			                }
		                }

		            }else{
		                return false;
		            }

		        }else{
		            return false;
		        }
		    }else{
			    throw new RuntimeException("Installation path [$path] is not writable.");
		    }

	    }

	}
?>