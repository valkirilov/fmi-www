<?php

require_once 'Model.php';

class UserModel extends Model {

	public $id;
	public $email;
	public $password;
	public $created_at;
	public $updated_at;
}