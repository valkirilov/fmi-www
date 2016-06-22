<?php

require_once 'Controller.php';
require_once PATH_ROOT . '/models/CategoryModel.php';

class HomepageController extends Controller {

	public function __construct() {
	}

	public function homepageView() {

		// Fetch all of the categories from the DB
		try {
			global $DB;
			$query = $DB->query("SELECT * FROM fmi_categories;", array(), 'CategoryModel');
			$categories = $query->fetchAll();

			$this->context['categories'] = $categories;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}

	}

}