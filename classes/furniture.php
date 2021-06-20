<?php 

require_once './classes/product.php';

class Furniture extends Product {
    public function __construct($sku, $name, $price, $type, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;

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
        newProduct($sku, $name, $price, $type, $this->attributes_id);

    }
}
