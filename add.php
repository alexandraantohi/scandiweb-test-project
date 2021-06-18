<?php 

require_once "./classes/database.php";




 

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

<body class="p-5">
    <nav class="navbar navbar-light border-bottom border-dark border-3 mb-3 padding ml-2">
            <a class="navbar-brand">Product Add</a>
            <form class="form-inline">
                <input type="submit" form="product_form" ><a href="add.php" class="btn btn-light border border-dark rounded-0 border-2">Save</a></input>
                <button class="btn btn-light my-1 border border-dark rounded-0 border-2" >Cancel</button>
            </form>
        
    </nav>

    <form id="product_form" class="col-md-6"  method="POST" action="index.php">
        <div class="form-group row ">
            <label for="sku" class="col-sm-2 col-form-label">SKU</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sku" name="sku" value="123" placeholder="Enter sku">
            </div>
            <div class="invalid-feedback">Please provide a valid SKU</div>
        </div>
        <br>

        <div class="form-group row ">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="Ceva" placeholder="Enter name" >
            </div>
        </div>
        <br>

        <div class="form-group row ">
            <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="price" name="price" value="50" placeholder="Enter price" >
            </div>
        </div>
        <br>

        <div class="form-group row ">
            <label for="productType" class="col-sm-2 col-form-label">Type Switcher</label>
            <div class="col-sm-10">
                <select class="custom-select mr-sm-2" id="productType" name="type">
                    <option selected value="dvd" id="DVD">DVD</option>
                    <option value="furniture" id="Furniture">Furniture</option>
                    <option value="book" id="Book">Book</option>
                </select>
            </div>
        </div>
        <br>

        <!-- DVD product description -->
        <div id="dvdDetails">
            <div class="form-group row ">
                <label for="size" class="col-sm-2 col-form-label">Size (MB)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="size" name="size" value="10" placeholder="Enter size" >
                </div>
            </div>
            <br>
        </div>
        

        <!-- Furniture product description -->
        <div id="furnitureDetails">
            <div class="form-group row ">
                <label for="height" class="col-sm-2 col-form-label">Height (CM)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="height" name="height" placeholder="Enter height" >
                </div>
            </div>
            <br>

            <div class="form-group row ">
                <label for="width" class="col-sm-2 col-form-label">Width (CM)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="width" name="width" placeholder="Enter width" >
                </div>
            </div>
            <br>

            <div class="form-group row ">
                <label for="length" class="col-sm-2 col-form-label">Length (CM)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="length" name="length" placeholder="Enter length" >
                </div>
            </div>
            <br>
        </div>
        

        <!-- Book product description -->
        <div id="bookDetails">
            <div class="form-group row ">
                    <label for="weight" class="col-sm-2 col-form-label">Weight (KG)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight" >
                    </div>
            </div>
            <br>
        </div>
        
    </form>

    <script src="switcher.js"></script>
</body>
</html>