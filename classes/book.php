<?php 

require_once './classes/product.php';

class Book extends Product {
    public function __construct($sku, $name, $price, $type, $weight)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->weight = $weight;

        
        //require_once "./classes/database.php";
        global $pdo;
        //Insert into book
        $statement = $pdo->prepare('INSERT INTO book (weight) VALUES(:weight)');
        $statement->bindValue(':weight', $weight);
        $pdo->beginTransaction();
        $statement->execute();
        $this->attributes_id = $pdo->lastInsertId();
        $pdo->commit();

        //insert into Products
        $statement = $pdo->prepare('INSERT INTO products (sku, name, price, type, attributes_id) VALUES(:sku, :name, :price, :type, :attributes_id)');
        $statement->bindValue(':sku', $sku);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':attributes_id', $this->attributes_id);
        $pdo->beginTransaction();
        $statement->execute();
        $pdo->commit();

    }
}

