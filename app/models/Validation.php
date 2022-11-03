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
        //$data = [];
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
        // if ($this->validateInput()) {
        //     $errors[] = $this->validateInput();
        // }
         //echo print_r($errors);
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
            return "Invalid price!";
        }
        return "";
        
    }
    private function validateType($type)
    {
        if($type === 'please choose') {
            return "Type was not provided!";
        }
        return "";
    }
    // public function validateInput(){
    //     if($type === 'disc' && empty(data['size'])) {
    //         return "Size was not provided!";
    //     }
    //     if($type === 'book' && !data['weight']) {
    //         return "Weight was not provided!";
    //     }
    //     if($type === 'furniture' && (!data['length'] && !data['width'] && !data['height'])) {
    //         return "Dimensions were not provided!";
    //     }
    //     return "";

    // }

}