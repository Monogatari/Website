<?php


	/**
	 * ==============================
	 * Aegis Framework | MIT License
	 * http://www.aegisframework.com/
	 * ==============================
	 */

	/**
	 * Include Aegis Library
	 *
	 * This includes the custom error handlers and the autoload function
	 * required to load classes dynamically.
	 */
	include ('lib/Aegis.php');

	// DB::connect (Configuration::db_user (), Configuration::db_password (), Configuration::db (), Configuration::db_host ());

	/**
	 * Debugging logs are shown on errors by default, to disable them,
	 * uncomment the following line.
	 */
	//Aegis::$debugging = false;

	/**
	 * Set domain name for Router
	 *
	 * This domain name is used for routing purposes and to load all resources
	 * correctly since it's used in the base tag for the pages. Set it to the
	 * path of your project.
	 */
	Router::$domain = Configuration::domain ();

	/**
	 * Register Routes
	 *
	 * Register all the custom routes for your site, the callback function
	 * will be executed when the route is accessed.
	 */
	Router::get ('/', function () {
		return new main ();
	});

	Router::get ('/documentation', function () {
		return new documentation ();
	});

	Router::get ('/documentation/{category}', function ($category) {
		return new documentation ($category);
	});

	Router::get ('/documentation/{category}/{article}', function ($category, $article) {
		return new documentation ($category, $article);
	});

	/**
	 * Make the router listen to requests.
	 *
	 * The router will now match any request to the previously registered
	 * routes and run the callback function of the match.
	 */
	Router::listen ();
?>