<?php 
namespace app\models;

use app\core\DB;


class Product extends DB
{
	private $table = "products";
	private $connection; 
	public $type = [];
	public $size='';

	public function __construct(){
		$this->connection = DB::connect();

	}
	public function fetchData()
	{
		//fetching data in descending order (lastest entry first)
		$query = "SELECT * FROM products ORDER BY id DESC";
		$result = $this->connection->query($query);

		return $result;
	}
	public function storeProduct($data){
		if(!empty($data['length'] && $data['width'] && $data['height'])){
				$dimension = 'Dimensions: ' .$data['length'] . " x " . $data['width'] . " x " . $data['height'];
			}else{
				$dimension = null;
			}
			//echo $data['name']; die;
			$sku = $data['sku'];	
			//echo $sku; die;
			$name = $data['name'];
			$price = $data['price'];
			$typeSwitch = $data['typeSwitch'];
			
			$type=[];
			$size='';
			$weight='';

			if(!empty($data['size'])){
				$size = 'Size: ' .$data['size']. ' MB';
			}
			if(!empty($data['weight'])){
				$weight = 'Weight: ' .$data['weight']. ' KG';
			}

			$type= array_filter([$size,$weight,$dimension]);
			$type = array_values($type);

			$value = $type[0];
			//var_dump($value); die;

		$query = "INSERT INTO products (sku,name,price,type,value) VALUES ('$sku','$name','$price','$typeSwitch','$value')";
		$result = $this->connection->query($query);
		return $result;
	}
	public function getSku($sku){
		if($sku != ''){

			$query = "SELECT * FROM products where sku='$sku'";
			$result=$this->connection->query($query);
			$count= mysqli_num_rows($result);
			if($count == 0){
				echo 'true';
	 			}else{
				echo 'false';
	 			}
			}
	}
	public function deleteProduct($id){
		//you may use sku or id
		$query = "DELETE from products WHERE id=".$id;
		$this->connection->query($query);
		
	}

}