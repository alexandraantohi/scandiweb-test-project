<?php
 
 require_once './classes/product.php';

class Dvd extends Product {
    private $size;

    public function __construct($sku, $name, $price, $type, $attributes) {
        parent::__construct($sku, $name, $price, $type, 0);
        $this->size = $attributes['size'];

    }

    public function getSize(){
        return $this->size;
    }

    public function insert() {
        global $pdo;
        //Insert into dvd
        $statement = $pdo->prepare('INSERT INTO dvd (size) VALUES(:size)');
        $statement->bindValue(':size', $this->getSize());
        $pdo->beginTransaction();
        $statement->execute();
        $this->setAttributesId($pdo->lastInsertId());
        $pdo->commit();

        
        //Insert into products
        $this->insertProduct();
    }
}