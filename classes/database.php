<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


function getProducts()
{
    global $pdo;
    $statement = $pdo->prepare('SELECT SKU, name, price, attributes_id,
    type, concat_ws("x",book.weight, dvd.size, furniture.width, furniture.height, furniture.length) as atributes
    FROM products 
    LEFT JOIN book ON book.id = attributes_id AND type = "book" 
    LEFT JOIN furniture ON furniture.id = attributes_id AND type = "furniture" 
    LEFT JOIN dvd ON dvd.id = attributes_id AND type = "dvd";');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
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

        $queries = array(
            "book" => 'DELETE FROM book WHERE id = :attributes_id',
            "dvd" => 'DELETE FROM dvd WHERE id = :attributes_id',
            "furniture" => 'DELETE FROM furniture WHERE id = :attributes_id'
        );


        $statement = $pdo->prepare($queries[$result['type']]);
        $statement->bindValue(':attributes_id', $result['attributes_id']);
        $statement->execute();
        $pdo->commit();

        $statement = $pdo->prepare('DELETE FROM products WHERE SKU = :sku');
        $statement->bindValue(':sku', $sku);
        $statement->execute();
    }
}