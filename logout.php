<?php
	
	/**
	 * ==============================
	 * Aegis Framework | MIT License
	 * http://www.aegisframework.com/
	 * ==============================
	 */

	$session = new Session();
	$session -> end();
	header("location:/");
?>