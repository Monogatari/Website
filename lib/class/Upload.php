<?php

	class Upload {

		public static $extensions;
		public static $maxSize;
		private $file;
		private $size;
		private $name;
		private $path;
		private $error;
		private $extension;

		function __construct ($file, $path) {
			$this -> file = $file;
			$this -> path ($path);
			$split = explode(".", $file["name"]);
			$this -> extension = end($split);
			$this -> name (str_replace (".{$this -> extension}", "", $this -> file["name"]));
			$this -> error = $this -> file["error"];
			$this -> size = $this -> file["size"];

			if ($this -> error > 0) {
				throw new Exception ("The file was not uploaded correctly.<p><b>Error Code:</b> {$this -> error}</p>", 1);
			}

			if ($this -> size > self::$maxSize) {
				throw new Exception ("The file exceeds the allowed upload size.<p><b>Size:</b> {$this -> size}</p>", 1);
			}
        }

		public function name ($name = null) {
			if ($name !== null) {
				$this -> name = Text::toFriendlyUrl($name);
			} else {
				return "{$this -> name}.{$this -> extension}";
			}
		}

		public function path ($path = null) {
			if ($path !== null) {
				$this -> path = $path;
			} else {
				return $this -> path;
			}
		}

		public static function extensions ($collection = null) {
			if ($collection !== null) {
				if (is_array ($collection)) {
					self::$extensions = new Collection ($collection);
				} else if (is_string ($collection)) {
					return new Collection (self::$extensions -> get ($collection));
				}
			} else {
				return self::$extensions;
			}
		}

		public static function size ($size = null) {
			if ($size !== null) {
				self::$maxSize = $size * 1024 * 1024;
			} else {
				return self::$maxSize;
			}
		}

		private function isImage () {
			if (self::extensions () -> hasKey ("image")) {
				return self::extensions ("image") -> contains ($this -> extension)
				&& (($this -> file["type"] == "image/gif")
	             || ($this -> file["type"] == "image/jpeg")
	             || ($this -> file["type"] == "image/jpg")
	             || ($this -> file["type"] == "image/pjpeg")
	             || ($this -> file["type"] == "image/x-png")
	             || ($this -> file["type"] == "image/png"));
			} else {
				return false;
			}
        }

		private function isText () {
			if (self::extensions () -> hasKey ("text")) {
				return self::extensions ("text") -> contains ($this -> extension);
			} else {
				return false;
			}
		}

		public function upload () {
			$location = "{$this -> path ()}/{$this -> name ()}";
			if ($this -> validate () === true) {
	            move_uploaded_file ($this -> file["tmp_name"], $location);
	            if($this -> file["type"] == "image/jpeg" || $this -> file["type"] == "image/jpg"){
	                Image::fixOrientation ($location);
	            }
	            return $location;
			} else {
				return $location;
			}
        }

		private function validate () {
			if (FileSystem::exists ($this -> path ())) {
				if (FileSystem::isWritable ($this -> path ())) {
					if (!FileSystem::exists ("{$this -> path ()}/{$this -> name ()}")) {
						if ($this -> isImage ()) {
							return true;
						} else {
							throw new Exception ("The file type could not be detected or it is not allowed. <p><b>File:</b> {$this -> name ()}</p>", 1);
						}
					} else {
						return false;
					}
				} else {
					throw new Exception ("The specified path is not writable.<p><b>Specified Path:</b> {$this -> path ()}</p>", 1);
				}

			} else {
				throw new Exception ("The specified path does not exist.<p><b>Specified Path:</b> {$this -> path ()}</p>", 1);
			}
        }

	}

?>