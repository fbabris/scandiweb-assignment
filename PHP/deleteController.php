<?php
require_once 'DeleteProduct.php';

$productDelete = new DeleteProduct();
$productDelete::setCorsHeaders();
$productDelete->deleteProduct($_POST['product_id']);