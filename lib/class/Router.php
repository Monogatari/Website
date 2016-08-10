<?php

	/**
	 * ==============================
	 * Router
	 * ==============================
	 */

	class Router {

		public $domain;
		private $routes;

		function __construct($domain = ""){
			$this -> domain = $domain == "" ? $_SERVER['HTTP_HOST'] : $domain;
			$this -> routes = array();
	    }

		public function getRoute(){
			$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
	    	$url = substr($_SERVER['REQUEST_URI'], strlen($basepath));
	    	if(strstr($url, '?')){
		    	 $url = substr($url, 0, strpos($url, '?'));
			}
	    	$url = '/' . trim($url, '/');
	    	$url = str_replace("index.php", "", $url);
	    	return $url;
		}

		public function getBaseUrl(){
			return $this -> getProtocol() . $this -> domain . '/';
		}

		public function getFullUrl(){
			return str_replace("//", "/", $this -> getBaseUrl() . $this -> getRoute());
		}

		public function registerRoute($route, $view){
			$this -> routes[$route] = $view;
		}

		public function getRoutes(){
			return $this -> routes;
		}

		public function match(){
			return array_key_exists($this -> getRoute(), $this -> routes) || array_key_exists($this -> getRoute() . "/", $this -> routes);
		}

		public function getView(){
			return $this -> routes[$this -> getRoute()];
		}

		public function getProtocol(){
			return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		}

		public function listen(){
			if($this -> match()){
				$view = $this -> getView();
				if(is_string($view)){
					include $view;
				}else if($view -> isCompilable()){
					echo  $view -> compile();
				}
			}else{
				include_once("error/404.html");
			}
		}
	}
?>
