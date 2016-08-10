<?php

	/**
	 * ==============================
	 * View
	 * ==============================
	 */

	class View {


		private $view;
		private $template;
		private $data;
		private $meta;
		private $viewContent;

		function __construct($template, $data = null, $meta = null, $view = "default.php"){
			$this -> template = $template;
			$this -> view = $view;
			$this -> data = $data;
			$this -> meta = $meta;
	    }

	    public function getView(){
		    return $this -> view;
	    }

	    public function isCompilable(){
		    return $this -> data != null || $this -> meta != null;
	    }

		public function compile(){
			$this -> setViewInformation();
			$this -> compileTemplates();
			return $this -> viewContent;
		}

		private function setViewInformation(){
			$this -> viewContent = file_get_contents("views/$this->view");
			if($this -> meta != null){
				foreach($this -> meta as $key => $value){
					$this -> viewContent = str_replace("{{".$key."}}", $value, $this -> viewContent);
				}
			}

			$this -> viewContent = str_replace("{>{content}<}", "{{> " . $this -> template . "}}", $this -> viewContent);
		}


		private function compileTemplates(){
			do{
				$this -> compileForEachTemplates();
				$this -> compileSimpleTemplates();
			}while($this -> hasCompilables());

		}

		private function hasCompilables(){
			preg_match_all('/(\{\{>(\s?)(.*)\}\}|\{\{each(\s)(.*)\}\})/', $this -> viewContent, $matches);
			return !empty($matches[0]);
		}

		private function compileSimpleTemplates(){
			preg_match_all('/\{\{>(\s?)(.*)\}\}/', $this -> viewContent, $matches);
			if(!empty($matches)){
				foreach($matches[0] as $match){
					$matchName = trim(str_replace(array("{{>", "}}"), array("", ""), $match));
					$templateContent = file_get_contents("templates/" . $matchName . ".html");

					if($this -> data != null){
						if(array_key_exists ($matchName, $this -> data)){
							foreach($this -> data[$matchName] as $key => $value){
								$templateContent = str_replace("{{".$key."}}", $value, $templateContent);
							}
						}
					}

					$this -> viewContent = str_replace($match, $templateContent, $this -> viewContent);
				}
			}
		}


		private function compileForEachTemplates(){
			preg_match_all('/\{\{each(\s)(.*)\}\}/', $this -> viewContent, $matches);

			if(!empty($matches)){
				foreach($matches[0] as $match){

					$expression = explode(" ", trim(str_replace(array("{{each ", "}}"), array("", ""), $match)));
					$viewData = $expression[0];
					$view = file_get_contents("templates/" . $expression[1] . ".html");
					$compiledView = "";

					foreach($this -> data[$viewData] as $key => $value){
						$temp = $view;

						foreach($value as $valueKey => $simpleValue){
							$temp = str_replace("{{".$valueKey."}}", $simpleValue, $temp);
						}

						$compiledView .= $temp;
					}

					$this -> viewContent = str_replace($match, $compiledView, $this -> viewContent);
				}
			}

		}


		function __destruct() {

	    }

	}
?>
