<?php
require 'SaveProduct.php';

$NewProduct = new SaveProduct(array_slice($_POST, 4));
$NewProduct::setCorsHeaders();

if (!$NewProduct->getSku($_POST['sku'])) {
    $NewProduct->setSKU($_POST['sku']);
    $NewProduct->setName($_POST['name']);
    $NewProduct->setPrice($_POST['price']);
    $NewProduct->setType($_POST['type']);
    $NewProduct->save();
} else {
    http_response_code(400);
    echo json_encode(["error" => "This SKU already exists"]);
    exit;
}
;