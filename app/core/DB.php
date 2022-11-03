<?php

namespace app\core;

use MYSQLI;


class DB 
{	
	private $_host = 'localhost';
	private $_username = 'root';
	private $_password = '';
	private $_database = 'test';
	
	protected $db;
	
	public function connect()
	{
		$this->db = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
		if(!$this->db){
			die("could not connect to the database: <be />". mysqli_connect_error());
			}
		$query= "CREATE TABLE if not exists products(
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			sku varchar(255) NOT NULL,
            name varchar(255) NOT NULL,
            price float NOT NULL,
            type varchar(255) NOT NULL,
            value varchar(255) NOT NULL)";
		if(!$this->db->query($query)){
			echo 'table not created'; die;

		}
		return $this->db;	
		
	}
}
