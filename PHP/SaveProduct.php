<?php

include 'DbCon.php';
class SaveProduct extends DbCon
{
    protected $attributes;
    protected $type;
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($attributes)
    {
        parent::__construct();
        $this->attributes = $attributes;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getSku($sku)
    {
        $db = $this->connect();
        $stmt = $db->prepare("SELECT COUNT(*) FROM products WHERE sku = ?");
        $stmt->execute([$sku]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function save()
    {
        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO products (sku, name, price, type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->sku, $this->name, $this->price, $this->type]);
        $productId = $db->lastInsertId();
        $this->attributes['product_id'] = $productId;

        $columns = implode(', ', array_keys($this->attributes));
        $placeholders = implode(', ', array_fill(0, count($this->attributes), '?'));
        $query = "INSERT INTO " . $this->type . " (" . $columns . ") VALUES (" . $placeholders . ")";
        $stmt = $db->prepare($query);

        $i = 1;
        foreach ($this->attributes as $value) {
            $stmt->bindValue($i++, $value);
        }
        $stmt->execute();
        $db = null;
    }
}

