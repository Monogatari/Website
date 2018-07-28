<?php

	class Image {

		public static function fixOrientation ($file) {
	        if (exif_imagetype($file) == 2) {
                $exif = exif_read_data ($file);
            	if (array_key_exists ('Orientation', $exif)) {
                	$orientation = $exif['Orientation'];
                    $images_orig = ImageCreateFromJPEG ($file);
                    $rotate = "";
					switch ($orientation) {
					   case 3:
					      $rotate = imagerotate ($images_orig, 180, 0);
					      break;
					   case 6:
					      $rotate = imagerotate ($images_orig, -90, 0);
					      break;
					   case 8:
					      $rotate = imagerotate ($images_orig, 90, 0);
					      break;
					}

					if ($rotate != "") {
	                    ImageJPEG ($rotate, $file);
	                    ImageDestroy ($rotate);
					}
					ImageDestroy ($images_orig);
            	}
            }
        }
	}

?>