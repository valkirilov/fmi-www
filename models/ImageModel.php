<?php

require_once 'Model.php';

class ImageModel extends Model {

	public $id;
	public $path;
	public $width;
	public $height;
	public $created_at;
	public $updated_at;

	public function fetchImages($filters) {
		try {
			global $DB;

			$sql = 'SELECT cat.*, imgs.* FROM fmi_category_image as img_cat
			    JOIN fmi_images imgs ON imgs.id = img_cat.image_id
			    JOIN fmi_categories cat ON cat.id = img_cat.category_id WHERE 1';
			$params = [];

			if (isset($filters['width'])) {
				$sql .= ' AND width >= :width';
				$params[':width'] = $filters['width'];
			}

			if (isset($filters['height'])) {
				$sql .= ' AND height >= :height';
				$params[':height'] = $filters['height'];
			}

			if (isset($filters['category'])) {
			  $sql .= ' AND name = :name';
			  $params[':name'] = $filters['category'];
			}

			$query = $DB->query($sql, $params, 'ImagesModel');
			$images = $query->fetchAll();

			return $images;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		  return false;
		}
	}
}