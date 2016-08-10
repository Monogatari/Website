<?php

	/**
	 * ==============================
	 * Aegis PHP 0.1.0 | MIT License
	 * http://www.aegisframework.com/
	 * ==============================
	 */


	function __autoload($className) {
	    require_once("class/$className.php");
	}

	if(file_exists("lib/library.php")){
		require_once("lib/library.php");
	}

	/**
	 * Error Handler.
	 *
	 * Detects when an errror Ocurrs
	 * and notifies it to support.
	 *
	 * @access public
	 * @param mixed $errorNumber
	 * @param mixed $errorString
	 * @param mixed $errorFile
	 * @param mixed $errorLine
	 * @return void
	 */
	function errorHandler($errorNumber, $errorString, $errorFile, $errorLine){
		if (!(error_reporting() && $errorNumber)) {
	        return false;
	    }
	    $error = "";
		switch ($errorNumber) {
		    case E_USER_ERROR:
		    	$error = "Fatal error [$errorNumber] $errorString\nOn line $errorLine in file $errorFile\nPHP " . PHP_VERSION . " (" . PHP_OS . ")";
		        exit(1);
		        break;

		    case E_USER_WARNING:
		        $error = "Warning [$errorNumber] $errorString\nOn line $errorLine in file $errorFile\nPHP " . PHP_VERSION . " (" . PHP_OS . ")";
		        break;

		    case E_USER_NOTICE:
		        $error = "Notice [$errorNumber] $errorString\nOn line $errorLine in file $errorFile\nPHP " . PHP_VERSION . " (" . PHP_OS . ")";
		        break;

		    default:
		        $error = "Unknown error type: [$errorNumber] $errorString\nOn line $errorLine in file $errorFile\nPHP " . PHP_VERSION . " (" . PHP_OS . ")";
		        break;
		}

		$mail = new Mail();
		$mail -> addRecipient("hyuchia@gmail.com");
		//$mail -> addRecipient("saavedra.f12@gmail.com");
		$mail -> addHeader("From: Moco Comics Error Handler <noreply@moco-comics.com>");
		$mail -> setSubject("Error Report");
		$mail -> setBody($error);
		$mail -> send();
    	return true;
	}

	/**
	 * Fatal Error Callback Function.
	 *
	 * Detects when a Fatal errror Ocurrs
	 * and notifies it to support.
	 *
	 * @access public
	 * @return void
	 */
	function shutDownFunction() {
	    $error = error_get_last();
	    if ($error['type'] == 1) {
		    $mail = new Mail();
			$mail -> addRecipient("hyuchia@gmail.com");
			//$mail -> addRecipient("saavedra.f12@gmail.com");
			$mail -> addHeader("From: Moco Comics Error Handler <noreply@moco-comics.com>");
			$mail -> setSubject("Error Report");
			$mail -> setBody('['.$error["type"].'] '.$error["message"].'\nFatal error on line '.$error["line"].' in file '.$error["file"].'\nPHP ' . PHP_VERSION . ' (' . PHP_OS . ')');
			$mail -> send();
			return true;
	    }
	}

	set_error_handler("errorHandler");
	register_shutdown_function('shutdownFunction');
?>