<?php

require_once PATH_ROOT . '/models/ImageModel.php';

class Uploader {

	/**
	 * Validate file by type, size and existance
	 * @param  [string] $file
	 * @return [boolean]
	 */
	public static function validate($file) {
		$uploadStatus = true;
		$imageFileType = pathinfo($file, PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
	    $checkImage = getimagesize($_FILES["image"]["tmp_name"]);
	    if($checkImage === false) {
        $_POST['message'] = "File is not an image.";
        $uploadStatus = false;
	    }
		}
		// Check if file already exists
		if ($uploadStatus && file_exists($file)) {
	    $_POST['message'] = "Sorry, file already exists.";
	    $uploadStatus = false;
		}
		// Check file size
		if ($uploadStatus && $_FILES["image"]["size"] > 500000) {
	    $_POST['message'] = "Sorry, your file is too large.";
	    $uploadStatus = false;
		}
		// Allow certain file formats
		if($uploadStatus && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
	    $_POST['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadStatus = false;
		}

		return $uploadStatus;
	}

	/**
	 * Upload a specific file
	 * @param  [string] $file
	 * @return [boolean]
	 */
	public static function upload($file) {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $file)) {
      $_POST['message'] = "The file ". basename($_FILES["image"]["name"]). " has been uploaded.";
      return self::store($file);
    } else {
      $_POST['message'] = "Sorry, there was an error uploading your file.";
      return false;
    }
	}

	/**
	 * Store info about the image in the DB
	 * @param  [type] $file [description]
	 * @return [type]       [description]
	 */
	public static function store($file) {
  	try {

  		$imageSize = getimagesize($file);

  		global $DB;
  		$result = $DB->query('INSERT INTO `fmi_images` (path, width, height, created_at, updated_at)
  			VALUES(:path, :width, :height, :created_at, :updated_at);', array(
	    	':path' => self::getUploadDirectory() . basename($_FILES["image"]["name"]),
	    	':width' => $imageSize[0],
	    	':height' => $imageSize[1],
	    	':created_at' => date("Y-m-d H:i:s", time()),
  		  ':updated_at' => date("Y-m-d H:i:s", time())
	  	));

  		self::addCategory($DB->getLastInsertId());

	  	return true;
		} catch(PDOException $e) {
			$_POST['message'] = $e->getMessage();
	  	return false;
		}
	}

	/**
	 * ѝшtach a specific category to a image by its id
	 * @param [type] $imageId [description]
	 */
	private static function addCategory($imageId) {
	  $categoryId = $_POST['category-id'];
	  global $DB;
	  try {
  	  $DB->query('INSERT INTO `fmi_category_image` (image_id, category_id, created_at, updated_at) VALUES(:image_id, :category_id, :created_at, :updated_at);', array(
  	      ':image_id' => $imageId,
  	      ':category_id' => $categoryId,
  	      ':created_at' => date("Y-m-d H:i:s", time()),
  	      ':updated_at' => date("Y-m-d H:i:s", time())
  	  ));

	  } catch(PDOException $e) {
	    $_POST['message'] = $e->getMessage();
	    return false;
	  }
	}

	/**
	 * Get the directory where the ploaded images are stored
	 * @return [string]
	 */
	public static function getUploadDirectory() {
		return "/uploads/";
	}

}