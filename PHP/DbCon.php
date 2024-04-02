<?php

class DbCon
{
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct()
    {
        $this->parseIni();
        $this->createDatabase();
        $this->createProductsTable();
        $this->createBookTable();
        $this->createFurnitureTable();
        $this->createDvdTable();
    }

    private function parseIni()
    {
        $iniFilePath = __DIR__ . '/config.ini';

        $config = parse_ini_file($iniFilePath, true);

        $this->host = $config["database"]['DB_HOST'] ?? '';
        $this->dbname = $config["database"]['DB_NAME'] ?? '';
        $this->username = $config["database"]['DB_USERNAME'] ?? '';
        $this->password = $config["database"]['DB_PASSWORD'] ?? '';
    }

    private function createDatabase()
    {
        try {
            $pdo = new PDO("mysql:host={$this->host};charset=utf8mb4", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
            $stmt->execute([$this->dbname]);

            if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
                $stmt = $pdo->prepare("CREATE DATABASE {$this->dbname}");
                $stmt->execute();
            }

        } catch (PDOException $e) {
            die("Database creation failed: " . $e->getMessage());
        }
    }

    private function createProductsTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                sku VARCHAR(255),
                name VARCHAR(255),
                type VARCHAR(255),
                price FLOAT
            )
        ";
        $this->connect()->exec($sql);
    }

    private function createDvdTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS dvd (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT,
                size FLOAT,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )
        ";
        $this->connect()->exec($sql);
    }

    private function createFurnitureTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS furniture (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT,
                height FLOAT,
                width FLOAT,
                length FLOAT,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )
        ";
        $this->connect()->exec($sql);
    }

    private function createBookTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS book (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT,
                weight FLOAT,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )
        ";
        $this->connect()->exec($sql);
    }


    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}