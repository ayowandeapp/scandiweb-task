<?php 

namespace app\models;

use app\core\DB;
use PDO;

class Product extends DB
{
	private $table = "products";
	private $connection; 
	public $sku;
	public $name;
	public $price;
	public $productType;
	public $value;

	public function __construct()
	{
		parent::__construct();
		$this->sku = null;
		$this->name = null;
		$this->price = null;
		$this->productType = null;
		$this->value = null;
	}

	public function setSku($sku)
	{
		$this->sku = $sku;
	}

	private function getSkuu()
	{
		return $this->sku;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	private function getName()
	{
		return $this->name;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	private function getPrice()
	{
		return $this->price;
	}

	public function setType($productType)
	{
		$this->productType = $productType;
	}

	private function getType()
	{
		return $this->productType;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	private function getValue()
	{
		return $this->value;
	}

	public function fetchData()
	{
		//fetching data in descending order (lastest entry first)
		$query = "SELECT * FROM products ORDER BY id DESC";
		$result = $this->db->prepare($query);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
	}

	public function storeProduct()
	{
		$query = "INSERT INTO products (sku, name, price, type, value) VALUES 
	        (:sku, :name, :price, :type, :value)";
	    $result = $this->db->prepare($query);
	    $result->bindParam(':sku', $this->getSkuu());
	    $result->bindParam(':name', $this->getName());
	    $result->bindParam(':price', $this->getPrice());
	    $result->bindParam(':type', $this->getType());
	    $result->bindParam(':value', $this->getValue());
	    $result->execute();
	}

	public function getSku($sku)
	{
		if ($sku != '') {
			$query = "SELECT * FROM products WHERE sku = :sku";
			$result=$this->db->prepare($query);
	    	$result->bindParam(':sku', $sku);
	    	$result->execute();
        	$result->setFetchMode(PDO::FETCH_ASSOC);
        	return $result->fetch();
		}
	}

	public function deleteProduct($id)
	{
		//you may use sku or id
		$query = "DELETE from products WHERE id = :id";
		$result=$this->db->prepare($query);
	    $result->bindParam(':id', $id);
	    $result->execute();
	}
}
