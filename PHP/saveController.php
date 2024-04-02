<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
header('Access-Control-Allow-Methods:  POST');
header("Access-Control-Allow-Credentials: true");
require 'SaveProduct.php';

$NewProduct = new SaveProduct(array_slice($_POST, 4));
if (!$NewProduct->getSku($_POST['sku'])) {
    $NewProduct->setSKU($_POST['sku']);
    $NewProduct->setName($_POST['name']);
    $NewProduct->setPrice($_POST['price']);
    $NewProduct->setType($_POST['type']);
    $NewProduct->save();
} else {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "This SKU already exists"]);
    exit;
}
;