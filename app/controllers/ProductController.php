<?php

namespace app\controllers;
use app\core\App;
use app\models\Product;
use app\models\Validation;


class ProductController{

	public static function index($params=[]){
		//var_dump($params); die;
		$db = new Product();
		$products = $db->fetchData();
		//var_dump($data['products']); die;
		App::renderView('index',['products'=>$products]);
	}
	public static function add_product(){
		$errors=[];
		//echo 'ok'; die;
		if(isset($_POST['Submit'])){
			
			$data = [];
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
			$formvalidate= new Validation();
			$errors['errors'] = $formvalidate->validateData($data);
			if (!$errors['errors']) {
				$db = new Product();
				$db->storeProduct($data);
				//header("Location:index.php");
				header('Location: /');
				exit;
			}
			}
		//echo var_dump($errors['errors']);
		App::renderView('product/add_product',$errors);
		exit;

	}
	public static function chk_sku($sku){
		//$sku=$_REQUEST["sku"];
		$sku = $sku[1];
		$db = new Product();
		$db->getSku($sku);
		}
	public static function delete_product(){
		if ($_POST) {
			//var_dump( $_POST); die;
			$db = new Product();
            foreach ($_POST as $key => $value) {
                $db->deleteProduct($key);
			}
			header('Location: /');
		}else{
			header('Location: /');
		}
	}





}