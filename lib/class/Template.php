<?php

	/**
	 * ==============================
	 * Template
	 * ==============================
	 */

	class Template {

		protected $page;
		protected $template;
		protected $content;
		protected $_title;
		protected $_keywords;
		protected $_description;
		protected $_twitter;
		protected $_google;
		protected $_shareimage;
		protected $_author;
		protected $_domain;
		protected $_route;
		protected $_fullRoute;
		public $data = [];

		/**
		 * Set the page to use for this template as base
		 *
		 * @param string $page | Page Name and Extension
		 */
		public function setPage($page){
			$this -> page = FileSystem::findFile(__DIR__."/../../pages", $page);
			$this -> compileContent();
		}

		/**
		 * Set the template file for this template
		 *
		 * @param string $template | Template Name and Extension
		 */
		public function setTemplate($template){
			$this -> template = FileSystem::findFile(__DIR__."/../../templates", $template);
			$this -> compileContent();
		}

		protected function compileContent(){
			if (is_string($this -> page)) {
				$this -> content = file_get_contents($this -> page);
				if(is_string($this -> template)){
					$this -> content = str_replace("{>{content}<}", file_get_contents($this -> template), $this -> content);
				}
			}else{
				if(is_string($this -> template)){
					$this -> content = file_get_contents($this -> template);
				}
			}
		}

		public function setContent($content){
			$this -> content = $content;
		}

		public function compile(){
			$this -> setProperties();
			$this -> includeTemplates();
			$this -> includeRepeats();
		}

		protected function setProperties(){
			$this -> _fullRoute = Router::getFullRoute();
			$this -> _route = Router::getRoute();
			$this -> _domain = Router::getDomain();
			preg_match_all('/\{\{((\w*|\d))\}\}/', $this -> content, $matches);
			if(!empty($matches)){
				foreach($matches[0] as $match){
					$matchName = trim(str_replace(array("{{", "}}"), array("", ""), $match));
					if(method_exists($this, $matchName)){
						$this -> content = str_replace($match, $this -> $matchName(), $this -> content);
					}else if (property_exists($this, $matchName)){;
						$this -> content = str_replace($match, $this -> $matchName, $this -> content);
					}else if (array_key_exists($matchName, $this -> data)){
						$this -> content = str_replace($match, $this -> data[$matchName], $this -> content);
					}

				}
			}
		}

		protected function includeTemplates(){
			preg_match_all('/\{\{>(\s?)(\w*|\d*)\}\}/', $this -> content, $matches);
			if(!empty($matches)){
				foreach($matches[0] as $match){
				    $matchName = trim(str_replace(array("{{>", "}}"), array("", ""), $match));
				    if(class_exists($matchName)){
				    	$template = new $matchName();
				    	$this -> content = str_replace($match, $template, $this -> content);
				    }else if(($found = FileSystem::findFile(__DIR__."/../../templates", "$matchName.html")) != null){
				    	$this -> content = str_replace($match, file_get_contents($found), $this -> content);
				    }
				}
			}
		}

		function __toString(){
			$this -> compile();
			return $this -> content;
		}

		protected function includeRepeats(){
			preg_match_all('/\{\{repeat(\s)(\w*|\d*)(\s)(\w*|\d*)\}\}/', $this -> content, $matches);

			if(!empty($matches)){
				foreach($matches[0] as $match){

					$expression = explode(" ", trim(str_replace(array("{{repeat ", "}}"), array("", ""), $match)));
					$class = $expression[0];
					$list = $expression[1];
					$content = "";

					if(method_exists($this, $list)){
						$objects = $this -> $list();
					}else if (property_exists($this, $list)){
						$objects = $this -> $list;
					}else{
						return null;
					}

					if (class_exists($class) === true && $class instanceof Template) {
						foreach($objects as $object){
							$template = new $class();
							foreach($object as $key => $value){
								$template -> $key = $value;
							}
							$content .= $template;
						}
					} else if(($found = FileSystem::findFile(__DIR__."/../../templates", "$class.html")) !== null){

						foreach($objects as $object){
							$temp = file_get_contents($found);
							preg_match_all('/\{\{((\w*|\d))\}\}/', $temp, $tempMatches);
							if(!empty($tempMatches)){
								foreach($tempMatches[0] as $tempMatch){
									$matchName = trim(str_replace(array("{{", "}}"), array("", ""), $tempMatch));
									if(array_key_exists($matchName, $object)){
										$temp = str_replace($tempMatch, $object[$matchName], $temp);
									}
								}
							}
							$content .= $temp;
						}
				    } else {
						throw new Exception ("Tried to instantiate a non-existent Template '$class'.",1);
					}

					$this -> content = str_replace($match, $content, $this -> content);
				}
			}
		}
	}
?>