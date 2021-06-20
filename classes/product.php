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
        $this->price = $price;
        $this->type = $type;
    }

   
    public function getProduct()
    {


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

function deleteProduct($sku)
{
    global $pdo;
    $statement = $pdo->prepare('SELECT attributes_id, type FROM products WHERE SKU = CAST(:sku AS int);');
    $statement->bindValue(':sku', $sku);
    $pdo->beginTransaction();
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        $result = $result[0];

        switch ($result['type']) {
            case 'book':
                $statement = $pdo->prepare('DELETE FROM book WHERE id = :attributes_id');
                break;
            case 'dvd':
                $statement = $pdo->prepare('DELETE FROM dvd WHERE id = :attributes_id');
                break;
            case 'furniture':
                $statement = $pdo->prepare('DELETE FROM furniture WHERE id = :attributes_id');
        }

        $statement->bindValue(':attributes_id', $result['attributes_id']);
        $statement->execute();
        $pdo->commit();

        $statement = $pdo->prepare('DELETE FROM products WHERE SKU = :sku');
        $statement->bindValue(':sku', $sku);
        $statement->execute();
    }
}

function newProduct($sku, $name, $price, $type, $attributes_id)
{
    global $pdo;

    $statement = $pdo->prepare('SELECT sku FROM products WHERE SKU = CAST(:sku AS int);');
    $statement->bindValue(':sku', $sku);
    $pdo->beginTransaction();
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($result === []) {
        $statement = $pdo->prepare('INSERT INTO products (sku, name, price, type, attributes_id) VALUES(:sku, :name, :price, :type, :attributes_id)');
        $statement->bindValue(':sku', $sku);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':attributes_id', $attributes_id);
        $statement->execute();
        $pdo->commit();
    }
}
