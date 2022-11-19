<?php

namespace app\core;

use PDO;

abstract class DB 
{	
	private $host = 'localhost';
	private $username = 'root';
	private $password = '';
	private $database = 'test';
	public $db;
	
	public function __construct()
	{
		$this->db = ( 
		new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password));
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = 
		"CREATE TABLE IF NOT EXISTS products(
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			sku varchar(255) NOT NULL,
            name varchar(255) NOT NULL,
            price float NOT NULL,
            type varchar(255) NOT NULL,
            value varchar(255) NOT NULL)";
		
		$this->db->exec($query);
		return $this->db;	
	}
}
