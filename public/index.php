<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\App;
use app\controllers\ProductController;

$app = new App();
//home
$app->get('/', [ProductController::class,'index']);
//add-product
$app->get('/product/add_product', [ProductController::class,'addProduct']);
$app->post('/product/add_product', [ProductController::class,'addProduct']);
//delete products
$app->post('/product/delete_product', [ProductController::class,'deleteProduct']);
//check sku
$app->get('/product/chk_sku', [ProductController::class,'chkSku']);

$app->prepareUrl();
