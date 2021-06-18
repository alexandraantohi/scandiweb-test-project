<?php

require_once "./classes/database.php";
require_once "./classes/book.php";
require_once "./classes/dvd.php";
require_once "./classes/furniture.php";
require_once "./classes/product.php";

global $pdo;
$errors = [];
$sku = "";
$name = "";
$price = "";
$type = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sku = $_REQUEST['sku'];
    $name = $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $type = $_REQUEST['type'];
    $weight = $_REQUEST['weight'];
    $size = $_REQUEST['size'];
    $height = $_REQUEST['height'];
    $width = $_REQUEST['width'];
    $length = $_REQUEST['length'];
    // echo $sku;
    // echo $name;
    // echo $price;
    // echo $type;
    // exit;

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
        switch($type) {
            case 'book': 
                $book = new Book($sku, $name, $price, $type, $weight);
                break;
            case 'dvd':
                echo "$type";
                $dvd = new Dvd($sku, $name, $price, $type, $size);
                break;
            case 'furniture':
                $furniture = new Furniture($sku, $name, $price, $type, $height, $width, $length);
                break;
        }


    //     $statement = $pdo->prepare("INSERT INTO products (SKU, name, price, type)
    //     VALUES (:SKU, :name, :price, :type)");

    //     $statement->bindValue(':SKU', $sku);
    //     $statement->bindValue(':name', $name);
    //     $statement->bindValue(':price', $price);
    //     $statement->bindValue(':type', $type);
    //     $statement->execute();
    //    //$pdo->commit();
    //     echo 'Post Added';
    }
 }


// $statement = $pdo->prepare('SELECT * FROM products');
$statement = $pdo->prepare('SELECT SKU, name, price, attributes_id, type, concat_ws("x",book.weight, dvd.size, furniture.width, furniture.height, furniture.length) as atributes FROM products LEFT JOIN book ON book.id = attributes_id AND type = "book" LEFT JOIN furniture ON furniture.id = attributes_id AND type = "furniture" LEFT JOIN dvd ON dvd.id = attributes_id AND type = "dvd" order by type;');

$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// print_r($products);


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="app.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Scandiweb Test Assignment</title>
</head>

<body>

    <div class="container">
        <!-- <header class="d-flex">
            <h1>Product List</h1>
            
            <a href="add.php" class="btn btn-light align-self-end">ADD</a> 
        </header> -->
        <nav class="navbar navbar-light border-bottom border-dark border-3 mb-3">
            <a class="navbar-brand">Product List</a>
            <form class="form-inline">
                <a href="add.php" class="btn btn-light border border-dark rounded-0 border-2">ADD</a>
                <button class="btn btn-light my-1 my-sm-0 border border-dark rounded-0 border-2" type="submit">MASS DELETE</button>
            </form>
        </nav>
        
    
        <div class="row">
        
            <?php foreach ($products as $product) { ?>
                <div class="col-md-3 col-lg-3 text-center p-5 border border-dark ">
                    <p><?php echo $product['SKU']?></p>
                    <p><?php echo $product['name']?></p>
                    <p><?php echo $product['price'] . "$"?></p>
                    <?php switch($product['type']) {
                        case 'dvd':
                            echo "Size: " . $product['atributes'] . "MB"; 
                            break;
                        case 'book':
                            echo "Weight: " . $product['atributes'] . "KG";
                            break;
                        case 'furniture':
                            echo "Dimension: " . $product['atributes'];
                            break;
                    }    ?>
                    
                </div>
            <?php } ?>

            
            <div class="col-md-3 col-lg-3 ">
            </div>   
            <div class="col-md-3 col-lg-3 ">bjhbbhebferbf</div>   
            <div class="col-md-3 col-lg-3 ">bjhbbhebferbf</div>   

        </div>
       
        <footer>Scandiweb Test assignment</footer>
    </div>
    
</body>

</html>