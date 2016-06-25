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
		$image = array_rand($images);

		$this->showImage($images[$image]);
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
	private function showImage($image) {
		$file = PATH_ROOT . $image['path'];

		// Read image path, convert to base64 encoding
		$imageData = base64_encode(file_get_contents($file));

		// Format the image SRC:  data:{mime};base64,{data};
		$src = 'data: '.mime_content_type($file).';base64,'.$imageData;

		// Echo out a sample image
		echo '<img src="' . $src . '">';
	}

}