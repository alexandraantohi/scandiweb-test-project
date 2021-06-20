<?php 

require_once './classes/product.php';

class Book extends Product {
    public function __construct($sku, $name, $price, $type, $weight)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->weight = $weight;

        global $pdo;
        //Insert into book
        $statement = $pdo->prepare('INSERT INTO book (weight) VALUES(:weight)');
        $statement->bindValue(':weight', $weight);
        $pdo->beginTransaction();
        $statement->execute();
        $this->attributes_id = $pdo->lastInsertId();
        $pdo->commit();

        //insert into Products
        newProduct($sku, $name, $price, $type, $this->attributes_id);

    }
}

