<?php
	/**
	 * ==============================
	 * Route
	 * ==============================
	 */

	class Route {

		/** @var string $route | Route to match */
		private $route;

		/** @var mixed $pattern | Array Representation Of Expected Route */
		private $pattern;

		/** @var function $action | Callback function */
		private $action;

		/** @var mixed $parameters | Reserved Array For Route Parameters */
		private $parameters;

		// Initialize Route
		function __construct($route, $action){
			$this -> route = $route;
			$this -> action = $action;
			$this -> pattern = explode("/", $route);
			$this -> parameters = array();
	    }


		/**
		 * Checks wether a given route matches the route pattern.
		 *
		 * @param string $route | Route to check against the pattern
		 *
		 * @return boolean | Returns if it matches.
		 */
		public function match($route){
			$route_pattern = explode("/", $route);

			if(count($route_pattern) != count(explode("/", $this -> route))){
			    return false;
			}

			$optionals = substr_count($route, "?");

			if ($optionals > 0){
			    if (count($this -> pattern) < count($route_pattern) - $optionals){
			        return false;
			    }
			}

			foreach($this -> pattern as $key => $value){

				if (strpos($value, "{") > -1 && strpos($value, "}") > -1) {
				    $name = str_replace(["{", "}", "?"], ["", "", ""], $value);
					array_push($this -> parameters, $route_pattern[$key]);
				}else{
				    if($value != $route_pattern[$key]){
						$this -> parameters = array();
				        return false;
				    }
				}
			}

			return true;
		}

		/**
		 * Run route's callback function
		 *
		 * @return string | Result of running the route's callback function
		 */
		public function run(){
			return call_user_func_array($this -> action, $this -> parameters);
		}

	}
?>