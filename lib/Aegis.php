<?php

	require_once ('class/HTTP.php');
	require_once ('class/Template.php');
	require_once ('class/FileSystem.php');

	/**
	 * Aegis class with framework settings and information
	 */
	class Aegis {
		// Show debugg Logs
		public static $debugging = true;

		// Aegis Flavor
		public static $flavor = 'Ikaros';

		// Flavor Version
		public static $version = '0.3.0';
	}

	if (FileSystem::exists (__DIR__ . '/../vendor/autoload.php')) {
		require_once (__DIR__ . '/../vendor/autoload.php');
	}
	/**
	 * Load classes dynamically
	 *
	 * Instead of doing it explicitly, Aegis will autoload the classes you use
	 * from the classes directory and the templates directory.
	 */
	spl_autoload_register (function ($className) {
		$file = FileSystem::findFile (__DIR__, "$className.php");
		if ($file !== null) {
			require_once ($file);
		}
	});



    /**
	 * Custom handler for exceptions.
	 *
	 * It will send a 500 error code and page with debugging information
	 * in case it is enabled.
	 */
    function exceptionHandler ($exception) {
        HTTP::error (500, $exception -> getCode(), $exception -> getMessage(), $exception -> getFile(), $exception -> getLine());
		return true;
    }

	/**
	 * Custom error handler for errors.
	 *
	 * It will send a 500 error code and page with debugging information
	 * in case it is enabled.
	 */
	function errorHandler ($errorNumber, $errorString, $errorFile, $errorLine){
		if (!(error_reporting() && $errorNumber)) {
	        return false;
	    }
		HTTP::error(500, $errorNumber, $errorString, $errorFile, $errorLine);
		return true;
	}

	/**
	 * Custom error handler for fatal errors
	 *
	 * It will send a 500 error code and page with debugging information
	 * in case it is enabled.
	 */
	function shutDownFunction() {
	    $error = error_get_last();
		if ($error['type']) {
			HTTP::error(500, $error['type'], $error['message'], $error['file'], $error['line']);
			return true;
		}
	}

    // Set custom exception handler function
    set_exception_handler('exceptionHandler');

	// Set custom error handler function
	set_error_handler('errorHandler');

	// Set custom fatal error handler function
	register_shutdown_function('shutDownFunction');


	// Turn off default error reporting
	error_reporting(0);

	// Initial Settings
	Configuration::load ();

	// Set File Upload Configuration
	Upload::extensions ([
		'image' => [
			'png',
			'jpg',
			'jpeg',
			'bmp',
			'gif',
			'webp'
		]
	]);

	// Set max upload size to 5MB
	Upload::size (5);


?>