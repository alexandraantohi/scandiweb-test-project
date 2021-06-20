<?php
 
 require_once './classes/product.php';

class Dvd extends Product {
    public function __construct($sku, $name, $price, $type, $size) {
        parent::__construct($sku, $name, $price, $type);
        $this->size = $size;
        global $pdo;
        //Insert into dvd
        $statement = $pdo->prepare('INSERT INTO dvd (size) VALUES(:size)');
        $statement->bindValue(':size', $size);
        $pdo->beginTransaction();
        $statement->execute();
        $this->attributes_id = $pdo->lastInsertId();
        $pdo->commit();

        
        //Insert into products
        newProduct($sku, $name, $price, $type, $this->attributes_id);
    }
}