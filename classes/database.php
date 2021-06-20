<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function addProductInDatabase()
{
    global $pdo;


    $sku = $_REQUEST['sku'];
    $name = $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $type = $_REQUEST['type'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {



        $statement = $pdo->prepare("INSERT INTO products (SKU, name, price, type)
            VALUES (:SKU, :name, :price, :type)");

        $statement->bindValue(':SKU', $sku);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':type', $type);
        $statement->execute();
        $pdo->commit();
    }
}

function getProducts()
{
    global $pdo;
    $statement = $pdo->prepare('SELECT SKU, name, price, attributes_id,
    type, concat_ws("x",book.weight, dvd.size, furniture.width, furniture.height, furniture.length) as atributes
    FROM products 
    LEFT JOIN book ON book.id = attributes_id AND type = "book" 
    LEFT JOIN furniture ON furniture.id = attributes_id AND type = "furniture" 
    LEFT JOIN dvd ON dvd.id = attributes_id AND type = "dvd" order by type;');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
