<?php

include_once 'DbCon.php';

class DeleteProduct extends DbCon
{
    public function deleteProduct($productId)
    {
        $db = $this->connect();

        $sql = "SELECT id FROM products WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            return "Product with ID $productId not found";
        }

        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$productId]);

        return "Product deleted successfully";
    }
}