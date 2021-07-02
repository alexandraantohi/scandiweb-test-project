<?php 

require_once './classes/product.php';

class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $type, $attributes)
    {
        parent::__construct($sku, $name, $price, $type, 0);
        $this->weight = $attributes['weight'];
    }

    public function getWeight() {
        return $this->weight;
    }

    public function insert() {
        global $pdo;
        //Insert into book
        $statement = $pdo->prepare('INSERT INTO book (weight) VALUES(:weight)');
        $statement->bindValue(':weight', $this->getWeight());
        $pdo->beginTransaction();
        $statement->execute();
        $this->setAttributesId($pdo->lastInsertId());
        $pdo->commit();

        //insert into Products
        $this->insertProduct();
    }
}

