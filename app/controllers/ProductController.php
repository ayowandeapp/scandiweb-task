<?php

namespace app\controllers;

use app\core\App;
use app\models\Product;
use app\models\Validation;

class ProductController
{
	public static function index($params=[])
	{
		$db = new Product();
		$products = $db->fetchData();
		App::renderView('index',['products'=>$products]);
	}

	public static function addProduct()
	{
		$errors=[];

		if (isset($_POST['Submit'])) {
			$data = [];

            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
            $classname = "app\\models\\ProductType\\" . $_POST['productType'];

            if (class_exists($classname)) {
                $productData = new $classname($data);
            } else {
            	echo $_POST['productType']; die;
            }
            $errors['errors'] = $productData->validateData();

			if (!$errors['errors']) {
				$product = new Product();
				$product->setSku($productData->sku);
				$product->setName($productData->name);
				$product->setPrice($productData->price);
				$product->setType($productData->productType);
				$product->setValue($productData->value);
				$product->storeProduct();
				header('Location: /');
				exit;
			}
		}
		App::renderView('product/add_product',$errors);
		exit;
	}

	public static function chkSku($sku)
	{
		$sku = $sku[1];
		$db = new Product();
		$result = $db->getSku($sku);

		if (empty($result)) {
			echo 'true';
 		} else {
			echo 'false';
 		}
	}

	public static function deleteProduct()
	{
		if ($_POST) {
			$db = new Product();

            foreach ($_POST as $key => $value) {
                $db->deleteProduct($key);
			}
			header('Location: /');
		} else {
			header('Location: /');
		}
	}
}
