<?php

	/**
	 * ==============================
	 * Router
	 * ==============================
	 */

	class Router {

		/** @var string $domain | Router Domain */
		public static $domain;

		/** @var mixed $routes | Collection Of Registered Routes */
		private static $routes = [
				"ANY" => [],
				"GET" => [],
				"POST" => [],
				"PUT" => [],
				"DELETE" => [],
				"PATCH" => [],
				"OPTIONS" => []
			];

		/**
		 * Register a route for access via GET method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function get($route, $action){
			self::registerRoute('GET', new Route($route, $action));
		}

		/**
		 * Register a route for access via POST method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function post($route, $action){
			self::registerRoute('POST', new Route($route, $action));
		}

		/**
		 * Register a route for access via PUT method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function put($route, $action){
			self::registerRoute('PUT', new Route($route, $action));
			self::registerRoute('OPTIONS', new Route($route, $action));
		}

		/**
		 * Register a route for access via PATCH method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function patch($route, $action){
			self::registerRoute('PATCH', new Route($route, $action));
			self::registerRoute('OPTIONS', new Route($route, $action));
		}

		/**
		 * Register a route for access via DELETE method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function delete($route, $action){
			self::registerRoute('DELETE', new Route($route, $action));
			self::registerRoute('OPTIONS', new Route($route, $action));
		}

		/**
		 * Register a route for access via OPTIONS method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function options($route, $action){
			self::registerRoute('OPTIONS', new Route($route, $action));
		}

		/**
		 * Register a route for access via any method.
		 *
		 * @param string $route | Route To Match
		 * @param function $action | Callback Function To Run When Accessed
		 */
		public static function any($route, $action){
			self::registerRoute('ANY', new Route($route, $action));
			self::registerRoute('OPTIONS', new Route($route, $action));
		}

		/**
		 * Add a route to the $routes array
		 *
		 * @param string $method | Method Used By The Route
		 * @param function $route | Route Object To Add
		 */
		private static function registerRoute($method, $route){
			array_push(self::$routes[$method], $route);
		}

		/**
		 * Find a registered route in the $routes array.
		 *
		 * The function will loop over all the collection of routes with the
		 * given method and the any method and checks if it matches the given
		 * route.
		 *
		 * @param string $method | Method Used
		 * @param string $route | Route To Find
		 *
		 * @return Route or null | The Route Object Or Null If Not Found
		 */
		private static function findRoute($method, $route){
			foreach(array_merge(self::$routes[$method], self::$routes['ANY']) as $registered){
				if($registered -> match($route)){
					return $registered;
				}
			}
			return null;
		}

		/**
		 * Get the current route
		 *
		 * Gets the current accesed route and removes the script that it's being
		 * accessed as well as the domain and protocol.
		 *
		 * @return string | Route
		 */
		public static function getRoute(){
			$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
	    	$url = substr($_SERVER['REQUEST_URI'], strlen($basepath));
	    	if(strstr($url, '?')){
		    	 $url = substr($url, 0, strpos($url, '?'));
			}
	    	$url = '/' . trim($url, '/');
	    	$url = str_replace("index.php", "", $url);
	    	return $url;
		}

		/**
		 * Get the router domain and protocol
		 *
		 * Gets the router domain and adds the protocol to it.
		 *
		 * @return string | Domain
		 */
		public static function getDomain(){
			if(self::isSecure()){
				return "https://".Router::$domain."/";
			}else{
				return "http://".Router::$domain."/";
			}
		}

		/**
		 * Gets the current domain and router
		 *
		 * @return string | Full Route
		 */
		public static function getFullRoute(){
			return rtrim(self::getDomain(), "/").self::getRoute();
		}

		/**
		 * Makes the Router listen for any requests and act accordingly
		 */
		public static function listen () {
			$found_route = self::findRoute($_SERVER['REQUEST_METHOD'], self::getRoute ());
			if($found_route != null){
				$content = $found_route -> run ();
				if (is_array ($content)) {
					if (HTTP::type () === null) {
						HTTP::type ("json");
					}
					echo new JSON ($content);
				} else {
					if (HTTP::type () === null) {
						HTTP::type ("html");
					}
					echo $content;
				}
			}else{
				HTTP::error (404);
			}
		}

		/**
		 * Check if the application is being served via HTTPS
		 */
		private static function isSecure(){
			return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443);
		}

	}
?>