<?php


class Product
{
    public $sku;
    public $name;
    public $price;
    public $type;
    public $attributes_id;

    //Constructor
    public function __construct($sku, $name, $price, $type)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $type;
        $this->type = $type;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }


    public function getProduct()
    {
        
        //require_once "./classes/database.php";
        global $pdo;

        switch ($this->type) {
            case "book":
                $statement = $pdo->prepare('SELECT products.name, book.weight 
                                            FROM products 
                                            JOIN book ON book.id = products.attributes_id 
                                            WHERE :sku = products.sku');

                break;

            case "dvd":
                $statement = $pdo->prepare('SELECT products.name, dvd.size
                                            FROM products
                                            JOIN dvd ON dvd.id = products.attributes_id
                                            WHERE :sku = products.sku');
                break;

            case "furniture":
                $statement = $pdo->prepare('SELECT products.name, furniture.height, furniture.width, furniture.length
                                            FROM products
                                            JOIN furniture ON furniture.id = products.attributes_id
                                            WHERE :sku = products.sku ');
                break;
        }
        $statement->bindValue(':sku', $this->sku);
        $pdo->beginTransaction();
        $statement->execute();
        $pdo->commit();
    }

    
}

