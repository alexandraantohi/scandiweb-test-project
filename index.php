<?php

require_once "./classes/database.php";
require_once "./classes/book.php";
require_once "./classes/dvd.php";
require_once "./classes/furniture.php";
require_once "./classes/product.php";

global $pdo;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['sku'])) {
        $sku = $_REQUEST['sku'];
        $name = $_REQUEST['name'];
        $price = $_REQUEST['price'];
        $type = $_REQUEST['type'];
        $weight = $_REQUEST['weight'];
        $size = $_REQUEST['size'];
        $height = $_REQUEST['height'];
        $width = $_REQUEST['width'];
        $length = $_REQUEST['length'];


        switch ($type) {
            case 'book':
                $book = new Book($sku, $name, $price, $type, $weight);
                break;
            case 'dvd':
                $dvd = new Dvd($sku, $name, $price, $type, $size);
                break;
            case 'furniture':
                $furniture = new Furniture($sku, $name, $price, $type, $height, $width, $length);
                break;
        }
    } else {
        foreach ($_POST['checkbox_product'] as $selected) {
            deleteProduct($selected);
        }
    }
}

$products = getProducts();

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
            <div class="float-right">
                <a href="add.php" class="btn btn-success ">ADD</a>
                <button class="btn btn-danger " type="submit" form="product_form">MASS DELETE</button>
            </div>
        </nav>



        <form class="row" action="index.php" id="product_form" method="post">
            <?php foreach ($products as $product) { ?>
                <div class="col-md-3 col-lg-3 text-center p-5 border border-dark ">
                    <input type="checkbox" class="delete-checkbox" name="checkbox_product[]" value="<?php echo $product['SKU'] ?>">
                    <p><?php echo $product['SKU'] ?></p>
                    <p><?php echo $product['name'] ?></p>
                    <p><?php echo $product['price'] . "$" ?></p>
                    <?php switch ($product['type']) {
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

        </form>




        <footer>Scandiweb Test assignment</footer>
    </div>

</body>

</html>