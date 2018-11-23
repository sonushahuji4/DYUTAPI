<?php
require_once 'Constant.php';

class DbConnect 
{
	private $conn;
	
	// Connecting to databaserequire_once __DIR__ . '/../vendor/autoload.php';
	public function connect() 
	{
		// Connecting to mysql database
		$this->conn = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );
		// return database handler
		return $this->conn;
	}
}


?>



