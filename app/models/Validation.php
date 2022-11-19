<?php 

namespace app\models;

use app\core\DB;

abstract class Validation extends DB
{
    public $sku;
    public $name;
    public $price;
    public $productType;
    public $value;
    public $data; 
    
    public function __construct($input)
    {
        $this->data = $input;
        parent::__construct();
    }

	public function validateData()
    {
        $this->sku = $this->data['sku']; 
        $this->name = $this->data['name'];
        $this->price = $this->data['price'];
        $this->productType = $this->data['productType'];

        $errors = [];
        if ($this->validateSku($this->sku)) {
            $errors[] = $this->validateSku($this->sku);
        }
        if ($this->validateName($this->name)) {
            $errors[] = $this->validateName($this->name);
        }
        if ($this->validatePrice($this->price)) {
            $errors[] = $this->validatePrice($this->price);
        }
        if ($this->validateType($this->productType)) {
            $errors[] = $this->validateType($this->productType);
        }
        if ($this->validateValue()) {
            $errors[] = $this->validateValue();
        }
        return $errors;
    }

    private function validateSku($sku)
    {
        if (!$sku) {
            return "SKU was not provided!";
        }
        $query = "SELECT * FROM products where sku='$sku'";
            $result=$this->db->query($query);
            $count= mysqli_num_rows($result);
        if ($count >0) {
            return "SKU already taken!";
        }
        $this->sku = $this->data['sku'];
        return "";
    }
    
    private function validateName($name)
    {
        if (!$name) {
            return "Name was not provided!";
        }
        $this->name = $this->data['name'];
        return "";
    }

    private function validatePrice($price)
    {
        if (!$price) {
            return "Price was not provided!";
        }

        if (!(strlen($price) > 0) || !(floatval($price) >= 0 || !filter_var($price, FILTER_VALIDATE_FLOAT))) {
            return "Invalid price Provided!";
        }
        $this->price = $this->data['price'];
        return "";
    }

    private function validateType($type)
    {
        if ($type === '') {
            return "Type was not provided!";
        }
        $this->productType = $this->data['productType'];
        return "";
    }

    abstract public function validateValue();
}
