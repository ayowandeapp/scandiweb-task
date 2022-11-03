<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\App;
use app\controllers\ProductController;

$app = new App();


$app->get('/', [ProductController::class,'index']);

//add-product
$app->get('/product/add_product', [ProductController::class,'add_product']);
$app->post('/product/add_product', [ProductController::class,'add_product']);

//delete products
$app->post('/product/delete_product', [ProductController::class,'delete_product']);



$app->get('/product/chk_sku', [ProductController::class,'chk_sku']);


$app->prepareURL();
?>