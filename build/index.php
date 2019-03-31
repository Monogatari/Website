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

	require_once ('vendor/autoload.php');

	use Ikaros\FileSystem;
	use Ikaros\HTTP;
	use Ikaros\Configuration;
	use Ikaros\Template;
	use Ikaros\Schema;
	use Ikaros\Router;

	/**
	 * Set root directory
	 *
	 * Once set, Aegis will autoload the classes you use
	 * from the classes directory and the templates directory.
	 */
	FileSystem::root (__DIR__);


	// Initial Settings
	Configuration::load ();


	/**
	 * Set domain name for Router
	 *
	 * This domain name is used for routing purposes and to load all resources
	 * correctly since it's used in the base tag for the pages. Set it to the
	 * path of your project.
	 */
	Router::domain (Configuration::domain ());

	/**
	 * Register Routes
	 *
	 * Register all the custom routes for your site, the callback function
	 * will be executed when the route is accessed.
	 */
	Router::get ('/', function () {
		return new main ();
	});

	Router::get ('/gallery', function () {
		return new gallery ();
	});

	Router::get ('/contributors', function () {
		return new contributors ();
	});

	/**
	 * Make the router listen to requests.
	 *
	 * The router will now match any request to the previously registered
	 * routes and run the callback function of the match.
	 */
	Router::listen ();
?>