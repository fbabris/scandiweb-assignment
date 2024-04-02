<?php

include_once 'DbCon.php';

class ReadAllProducts extends DbCon
{
    public function getAllProducts()
    {
        try {
            $db = $this->connect();
            $sql = "
                SELECT 
                    p.id AS product_id,
                    p.sku,
                    p.name,
                    p.price,
                    p.type,
                    d.size AS dvd_size,
                    f.height AS furniture_height,
                    f.width AS furniture_width,
                    f.length AS furniture_length,
                    b.weight AS book_weight
                FROM 
                    products p
                LEFT JOIN 
                    dvd d ON p.id = d.product_id
                LEFT JOIN 
                    furniture f ON p.id = f.product_id
                LEFT JOIN 
                    book b ON p.id = b.product_id
            ";
            $stmt = $db->query($sql);
            if (!$stmt) {
                throw new Exception("Error executing SQL query");
            }
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($products === false) {
                throw new Exception("Error fetching products from database");
            }
            $jsonProducts = json_encode($products);
            if ($jsonProducts === false) {
                throw new Exception("Error encoding products as JSON");
            }
            return $jsonProducts;
        } catch (Exception $e) {
            // Handle the exception (e.g., log the error, return an error response)
            return "Error: " . $e->getMessage();
        }
    }

    // Getter methods to retrieve product properties
    public function getProductId($product)
    {
        return $product['product_id'];
    }

    public function getSku($product)
    {
        return $product['sku'];
    }

    public function getName($product)
    {
        return $product['name'];
    }

    public function getPrice($product)
    {
        return $product['price'];
    }

    public function getType($product)
    {
        return $product['type'];
    }

    public function getDvdSize($product)
    {
        return $product['dvd_size'];
    }

    public function getFurnitureHeight($product)
    {
        return $product['furniture_height'];
    }

    public function getFurnitureWidth($product)
    {
        return $product['furniture_width'];
    }

    public function getFurnitureLength($product)
    {
        return $product['furniture_length'];
    }

    public function getBookWeight($product)
    {
        return $product['book_weight'];
    }
}