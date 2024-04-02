<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Credentials: true");

require_once 'DeleteProduct.php';


$data = $_POST['product_id'];

$productDelete = new DeleteProduct();
$productDelete->deleteProduct($data);