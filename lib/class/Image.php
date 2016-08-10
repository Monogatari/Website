<?php
/**
 * ==============================
 * Image
 * ==============================
 */
class Image extends File{

		private $image;

		function __construct($image){
            $this -> image = $image;
        }

        public function getWidth(){
	        list($width, $height, $type, $attr) = getimagesize($this -> image);
	        return $width;
        }

        public function getHeight(){
	        list($width, $height, $type, $attr) = getimagesize($this -> image);
	        return $height;
        }

        public function resize($width, $height){
	        $type = exif_imagetype($this -> image);
	        if ($type == 2){
                $images_orig = ImageCreateFromJPEG($this -> image);
            }elseif ($type == 3){
                $images_orig = ImageCreateFromPNG($this -> image);
            }elseif ($type == 1){
                $images_orig = ImageCreateFromGIF($this -> image);
            }else{
	            return false;
            }

            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
			$images_fin = ImageCreateTrueColor($width, $height);
			ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

            if ($type == 2){
                ImageJPEG($images_fin, $this -> image);
            }elseif ($type == 3){
                ImagePNG($images_fin, $this -> image);
            }elseif ($type == 1){
                ImageGIF($images_fin, $this -> image);
            }
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
            return true;
        }

        public function fixOrientation(){
	        if(exif_imagetype($this -> image) == 2){
                $exif = exif_read_data($this -> image);
            	if(array_key_exists('Orientation', $exif)){
                	$orientation = $exif['Orientation'];
                    $images_orig = ImageCreateFromJPEG($this -> image);
                    $rotate = "";
					switch ($orientation) {
					   case 3:
					      $rotate = imagerotate($images_orig, 180, 0);
					      break;
					   case 6:
					      $rotate = imagerotate($images_orig, -90, 0);
					      break;
					   case 8:
					      $rotate = imagerotate($images_orig, 90, 0);
					      break;
					}
					if($rotate != ""){
	                    ImageJPEG($rotate, $this -> image);
	                    ImageDestroy($rotate);
					}
					ImageDestroy($images_orig);
				}
            }
        }

		function __destruct() {

        }

    }

?>