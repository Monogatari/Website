<?php

	/**
	 * ==============================
	 * RSS
	 * ==============================
	 */

	class RSS {

		private $title;
		private $description;
		private $author;
		private $link;
		private $date;
		private $items = [];

	    function __construct($url){
		    $this -> rss = (new SimpleXMLElement(file_get_contents($url))) -> channel;
		    $this -> title = $this -> rss -> title;
		    $this -> description = $this -> rss -> description;
		    $this -> cover = $this -> rss -> image -> url;
		    $this -> link = $this -> rss -> link;
		    $this -> items = $this -> decodeItems();
	    }

	    public function decodeItems(){
		    $array = [];
		    $temporal = [];
		    foreach($this -> rss -> item as $item){
			    foreach($item as $key => $value){
					if($key == "enclosure"){
						$temporal["audio"] = $value -> attributes()["url"][0];
					}else{
						$temporal[$key] = $value ;
					}
				}
				array_push($array, $temporal);
				$temporal = [];
		    }
		    return $array;
	    }

	    public function getTitle(){
		    return $this -> title;
	    }

	    public function getDescription(){
		    return $this -> description;
	    }

	    public function getCover(){
		    return $this -> cover;
	    }

	    public function getLink(){
		    return $this -> link;
	    }

	    public function getItems(){
		    return $this -> items;
	    }

		public function getItem($position){
			return $this -> items[$position];
		}
	}
?>