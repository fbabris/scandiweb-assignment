<?php

include_once 'DbCon.php';

class DeleteProduct extends DbCon
{
    public function deleteProduct($productId)
    {
        $db = $this->connect();
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$productId]);

        return "Product deleted successfully";
    }
}