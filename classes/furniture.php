<?php 

require_once './classes/product.php';

class Furniture extends Product {
    public function __construct($sku, $name, $price, $type, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;

        
        //require_once "./classes/database.php";
        global $pdo;
        //Insert into furniture
        $statement = $pdo->prepare('INSERT INTO furniture (height, width, length) VALUES(:height, :width, :length)');
        $statement->bindValue(':height', $height);
        $statement->bindValue(':width', $width);
        $statement->bindValue(':length', $length);
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
