<?php

require_once 'Controller.php';
require_once PATH_ROOT . '/helpers/auth.php';
require_once PATH_ROOT . '/helpers/uploader.php';

require_once PATH_ROOT . '/models/UserModel.php';
require_once PATH_ROOT . '/models/ImageModel.php';

class UploadController extends Controller {

	private $imagesModel;

	public $context;

	public function __construct() {
		$this->imagesModel = new ImageModel();
		$this->context = array();
	}

	public function uploadView() {
		if (!Auth::isLogged()) {
			header('Location: login.php');
			exit;
		}

		// Fetch all of the images from the DB
		try {
			global $DB;
			$query = $DB->query("SELECT * FROM fmi_images;", array(), 'ImageModel');
			$images = $query->fetchAll();

			$query = $DB->query("SELECT * FROM fmi_categories;", array(), 'CategoryModel');
			$categories = $query->fetchAll();

			$this->context['images'] = $images;
			$this->context['categories'] = $categories;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function uploadAction() {

		// Some config for the place where we want to upload the files
		$uploadsDirectory = PATH_ROOT . Uploader::getUploadDirectory();
		$file = $uploadsDirectory . basename($_FILES["image"]["name"]);

		// Validate the file
		$_POST['status'] = Uploader::validate($file);

		// Finally, try to upload the file
		if ($_POST['status']) {
	    $_POST['status'] = Uploader::upload($file);
		}
	}

}