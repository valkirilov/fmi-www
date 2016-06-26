<?php

require_once 'Controller.php';

require_once PATH_ROOT . '/models/ImageModel.php';

class ImagesController extends Controller {

	private $imagesModel;

	public function __construct() {
		$this->imagesModel = new ImageModel();
	}

	/**
	 * The main view which controls the process to read the input, fetch the images from the database and then
	 * ouput the chosen one
	 * @return [type] [description]
	 */
	public function imagesView() {
		$filters = $this->parseUrl();
		$images = $this->imagesModel->fetchImages($filters);

		// Todo check is the array empty
		if (count($images) == 0) {
			echo "TODO: Show empty image";
			return;
		}

		$image = array_rand($images);

		$this->showImage($images[$image], $filters);
	}

	/**
	 * Pasre the input url to display the best image
	 * @return [type] [description]
	 */
	private function parseUrl() {
		$filters = [];

		if (isset($_GET['width'])) {
			$filters['width'] = $_GET['width'];
		}
		if (isset($_GET['height'])) {
			$filters['height'] = $_GET['height'];
		}
		if (isset($_GET['category'])) {
			$filters['category'] = $_GET['category'];
		}

		return $filters;
	}

	/**
	 * Output the image with the correct mime type
	 * @param  [type] $image [description]
	 * @return [type]        [description]
	 */
	private function showImage($image, $filters) {
		$file = PATH_ROOT . $image['path'];

		$image = $this->resize_image(imagecreatefrompng($file), $filters['width'], $filters['height']);

		ob_start ();

	  imagepng ($image);
	  $imageData = ob_get_contents ();

		ob_end_clean ();

		$image_data_base64 = base64_encode($imageData);

		// Format the image SRC:  data:{mime};base64,{data};
		$src = 'data: '.mime_content_type($file).';base64,'.$image_data_base64;

		// Echo out a sample image
		echo '<img src="' . $src . '">';
	}

	/**
	 * Resize the image and crop it if it is needed
	 * @param  [type] $image  [description]
	 * @param  [type] $width  [description]
	 * @param  [type] $height [description]
	 * @return [type]         [description]
	 */
	private function resize_image($image, $width, $height) {
   	$originalWidth = @imagesx($image); //current width
   	$originalHeight = @imagesy($image); //current height
   	if ((!$originalWidth) || (!$originalHeight)) {
   		echo 'Image couldn\'t be resized because it wasn\'t a valid image.';
   		return false;
   	}

   	// If the width an height of the image are exact the same as the requested, we don't have to resize the image
   	if (($originalWidth == $width) && ($originalHeight == $height)) {
   		return $image;
 		}

   	// Try to resize the image with max width
  	$ratio = $width / $originalWidth;
  	$newWidth = $width;
  	$newHeight = $originalHeight * $ratio;

  	// If the calculated result heigh is smaller than what we need, lets revert ir and use max height
  	if ($newHeight < $height) {
  		$ratio = $height / $originalHeight;
  		$newHeight = $height;
  		$newWidth = $originalWidth * $ratio;
  	}

  	$image2 = imagecreatetruecolor($newWidth, $newHeight);
  	imagecopyresampled($image2, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

  	// Lets' check is the image requires cropping
  	if (($newHeight != $height) || ($newWidth != $width)) {
 		$image3 = imagecreatetruecolor($width, $height);
  		if ($newHeight > $height) { // Crop vertically
  			$extra = $newHeight - $height;
  			$x = 0; // Original x
  			$y = round($extra / 2); // Original y
  			imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
  		} else {
  			$extra = $newWidth - $width;
  			$x = round($extra / 2); // Original x
  			$y = 0; // Original y
  			imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
  		}

  		imagedestroy($image2);
  		return $image3;
  	} else {
  		return $image2;
  	}
  }

}