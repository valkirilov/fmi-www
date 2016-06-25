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

			$sql = 'SELECT * FROM fmi_images WHERE 1';
			$params = [];

			if (isset($filters['width'])) {
				$sql .= ' AND width >= :width';
				$params[':width'] = $filters['width'];
			}

			if (isset($filters['height'])) {
				$sql .= ' AND height >= :height';
				$params[':height'] = $filters['height'];
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