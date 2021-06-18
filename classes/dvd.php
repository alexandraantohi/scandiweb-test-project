<?php
 
 require_once './classes/product.php';

class Dvd extends Product {
    public function __construct($sku, $name, $price, $type, $size) {
        parent::__construct($sku, $name, $price, $type);
        $this->size = $size;
        echo 'orice';
        global $pdo;
        //Insert into dvd
        $statement = $pdo->prepare('INSERT INTO dvd (size) VALUES(:size)');
        $statement->bindValue(':size', $size);
        $pdo->beginTransaction();
        $statement->execute();
        $this->attributes_id = $pdo->lastInsertId();
        $pdo->commit();

        
        //Insert into products
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