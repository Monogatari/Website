<?php

	/**
	* ==============================
	* Config
	* ==============================
	*/

	class Configuration {

		private static $configuration;

		public static function load () {
			if (FileSystem::exists (__DIR__."/../../.conf")) {
				$content = FileSystem::read (__DIR__."/../../.conf");
				self::$configuration = new Collection ($content);
			}
		}

		public static function __callStatic ($name, $arguments) {
			if (self::$configuration !== null) {
				if (self::$configuration -> hasKey ($name)) {
					return self::$configuration -> get ($name);
				} else {
					return null;
				}
			} else {
				throw new Exception("Configuration is not loaded.", 1);
			}
		}
	}
?>