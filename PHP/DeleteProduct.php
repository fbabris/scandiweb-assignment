<?php

include_once 'DbCon.php';

class DeleteProduct extends DbCon
{
    public function deleteProduct($productId)
    {
        try {
            $db = $this->connect();
            // $productId = intval($productId);
            error_log("Received product ID: $productId");
            $sql = "SELECT id FROM products WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$productId]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Fetched product: " . print_r($product, true));

            if (!$product) {
                return "Product with ID $productId not found";
            }
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$productId]);

            return "Product deleted successfully";
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
    }
}