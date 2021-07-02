<?php


class Product
{
    private $sku;
    private $name;
    private $price;
    public $type;
    private $attributes_id;

    //Constructor
    public function __construct($sku, $name, $price, $type, $attributes_id)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attributes_id = $attributes_id;
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
        $queries = array(
            "furniture" => 'SELECT products.name, furniture.height, furniture.width, furniture.length
                            FROM products
                            JOIN furniture ON furniture.id = products.attributes_id
                            WHERE :sku = products.sku ',
            "book" => 'SELECT products.name, book.weight 
                       FROM products 
                       JOIN book ON book.id = products.attributes_id 
                       WHERE :sku = products.sku',
            "dvd" => 'SELECT products.name, dvd.size
                      FROM products
                      JOIN dvd ON dvd.id = products.attributes_id
                      WHERE :sku = products.sku'
        );

        global $pdo;

        $statement = $pdo->prepare($queries[$this->type]);
        $statement->bindValue(':sku', $this->sku);
        $pdo->beginTransaction();
        $statement->execute();
        $pdo->commit();
    }

    public function getAttributesId() {
        return $this->attributes_id;
    }

    public function setAttributesId($attributes_id) {
        $this->attributes_id = $attributes_id;
    }

    function insertProduct()
    {
        global $pdo;
        $statement = $pdo->prepare('SELECT sku FROM products WHERE SKU = :sku;');
        $statement->bindValue(':sku', $this->getSku());
        $pdo->beginTransaction();
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($result == []) {
            $statement = $pdo->prepare('INSERT INTO products (sku, name, price, type, attributes_id) VALUES(:sku, :name, :price, :type, :attributes_id)');
            $statement->bindValue(':sku', $this->getSku());
            $statement->bindValue(':name', $this->getName());
            $statement->bindValue(':price', $this->getPrice());
            $statement->bindValue(':type', $this->getType());
            $statement->bindValue(':attributes_id', $this->getAttributesId());
            $statement->execute();
            $pdo->commit();
        }
        
    }
}


