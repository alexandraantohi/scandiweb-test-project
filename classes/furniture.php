<?php

require_once './classes/product.php';

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $type, $attributes)
    {
        parent::__construct($sku, $name, $price, $type, 0);
        $this->height = $attributes['height'];
        $this->width = $attributes['width'];
        $this->length = $attributes['length'];
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getLength() {
        return $this->length;
    }

    public function insert()
    {
        global $pdo;
        //Insert into furniture
        $statement = $pdo->prepare('INSERT INTO furniture (height, width, length) VALUES(:height, :width, :length)');
        $statement->bindValue(':height', $this->getHeight());
        $statement->bindValue(':width', $this->getWidth());
        $statement->bindValue(':length', $this->getLength());
        $pdo->beginTransaction();
        $statement->execute();
        $this->setAttributesId($pdo->lastInsertId());
        $pdo->commit();

        //insert into Products
        $this->insertProduct();
    }
}
