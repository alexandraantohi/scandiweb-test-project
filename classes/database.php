<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function addProductInDatabase() {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $errors = [];
    $sku = $_REQUEST['sku'];
    $name = $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $type = $_REQUEST['type'];
    

     if($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(!$sku) {
            $error[] = 'Product sku is required';
        }

        if(!$name) {
            $error[] = 'Product name is required';
        }

        if(!$price) {
            $error[] = 'Product price is required';
        }

        if(!$type) {
            $error[] = 'Product type is required';
        }

        if(empty($errors)) {
            $statement = $pdo->prepare("INSERT INTO products (SKU, name, price, type)
            VALUES (:SKU, :name, :price, :type)");

            $statement->bindValue(':SKU', $sku);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':type', $type);
            $statement->execute();
            $pdo->commit();
            echo 'Post Added';
        }
     }
    
   
}
