<?php 

namespace app\models;

use app\core\DB;

class Validation extends DB{
    private $connection; 
    

    public function __construct(){
        $this->connection = DB::connect();

    }
	public function validateData($data)
    {
        $this->sku = $data['sku'];  
        //echo $this->sku; die;  
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->type = $data['typeSwitch'];

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

        if ($this->validateType($this->type)) {
            $errors[] = $this->validateType($this->type);
        }
        if($this->type === 'disc'){
            //echo $data['size']; die;
            if ($this->validateDisc($data['size'])) {
            $errors[] = $this->validateDisc($data['size']);
            //var_dump($errors); die;
            }
        }
        if($this->type === 'book'){
            if ($this->validateBook($data['weight'])) {
            $errors[] = $this->validateBook($data['weight']);
            //var_dump($errors); die;
            }
        }
        if($this->type === 'furniture'){
            //echo $data['size']; die;
            $ls = ['length'=>$data['length'],'weight'=>$data['width'],'height'=>$data['height']];
            if ($this->validateFurniture($ls)) {
            $errors[] = $this->validateFurniture($ls);
            //var_dump($errors); die;
            }
        }
        return $errors;
    }
    private function validateSku($sku)
    {
        if(!$sku) {
            return "SKU was not provided!";
        }
        $query = "SELECT * FROM products where sku='$sku'";
            $result=$this->connection->query($query);
            $count= mysqli_num_rows($result);
        if ($count >0) {
            return "SKU already taken!";
        }
        return "";
    }
    private function validateName($name)
    {
        if(!$name){
            return "Name was not provided!";
        }
        return "";
    }

    private function validatePrice($price)
    {
        if(!$price){
            return "Price was not provided!";
        }

        if (!(strlen($price) > 0) || !(floatval($price) >= 0 || !filter_var($price, FILTER_VALIDATE_FLOAT))) {
            return "Invalid price Provided!";
        }
        return "";
        
    }
    private function validateType($type)
    {
        if($type === '') {
            return "Type was not provided!";
        }
        return "";
    }
    private function validateDisc($size)
    {
        if(!$size){
            return "Size was not provided!";
        }

        if (!(strlen($size) > 0) || !(floatval($size) >= 0 || !filter_var($size, FILTER_VALIDATE_FLOAT))) {
            return "Invalid Size Provided!";
        }
        return "";
        
    }
    private function validateBook($weight)
    {
        if(!$weight){
            return "weight was not provided!";
        }

        if (!(strlen($weight) > 0) || !(floatval($weight) >= 0 || !filter_var($weight, FILTER_VALIDATE_FLOAT))) {
            return "Invalid weight Provided!";
        }
        return "";
        
    }
    private function validateFurniture($data)
    {
        //var_dump($data); die;
        foreach ($data as $key => $value) {
            if(!$value){
            return $key." was not provided!";
            }        

            if (!(strlen($value) > 0) || !(floatval($value) >= 0 || !filter_var($value, FILTER_VALIDATE_FLOAT))) {
                return "Invalid". $key ." Provided!";
            }
        }
        return "";
        
    }
}