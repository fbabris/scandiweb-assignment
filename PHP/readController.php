<?php
require 'ReadAllProducts.php';

$readAllProducts = new ReadAllProducts();
$readAllProducts::setCorsHeaders();
$allProducts = $readAllProducts->getAllProducts();
echo $allProducts;