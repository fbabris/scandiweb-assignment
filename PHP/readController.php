<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods:  POST');
header("Access-Control-Allow-Credentials: true");
require 'ReadAllProducts.php';

$readAllProducts = new ReadAllProducts();

try {
    $allProducts = $readAllProducts->getAllProducts();

    header('Content-Type: application/json');
    echo $allProducts;
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array("error" => $e->getMessage()));
}