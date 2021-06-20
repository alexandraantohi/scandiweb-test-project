
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

        <a href="index.php" class="btn btn-light border border-dark rounded-0 border-2">Cancel</a>
        <button class="btn btn-light my-1 border border-dark rounded-0 border-2" type="submit" form="product_form">Save</button>


    </nav>

    <form id="product_form" class="col-md-6" method="POST" action="index.php">
        <div class="form-group row ">
            <label for="sku" class="col-sm-2 col-form-label">SKU</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter sku" required>
            </div>
            <div class="invalid-feedback">Please provide a valid SKU</div>
        </div>
        <br>

        <div class="form-group row ">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
            </div>
        </div>
        <br>

        <div class="form-group row ">
            <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required oninput="check(this)">
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
        <div id="productDetails">


            <!-- DVD product description -->
            <div id="dvdDetails">
                <div class="form-group row ">
                    <label for="size" class="col-sm-2 col-form-label">Size (MB)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control product-details" id="size" name="size"  placeholder="Enter size" required oninput="check(this)">
                    </div>
                </div>
                <br>
            </div>


            <!-- Furniture product description -->
            <div id="furnitureDetails">
                <div class="form-group row ">
                    <label for="height" class="col-sm-2 col-form-label">Height (CM)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control product-details" id="height" name="height" placeholder="Enter height" oninput="check(this)">
                    </div>
                </div>
                <br>

                <div class="form-group row ">
                    <label for="width" class="col-sm-2 col-form-label">Width (CM)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control product-details" id="width" name="width" placeholder="Enter width" oninput="check(this)">
                    </div>
                </div>
                <br>

                <div class="form-group row ">
                    <label for="length" class="col-sm-2 col-form-label">Length (CM)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control product-details" id="length" name="length" placeholder="Enter length" oninput="check(this)">
                    </div>
                </div>
                <br>
            </div>


            <!-- Book product description -->
            <div id="bookDetails">
                <div class="form-group row ">
                    <label for="weight" class="col-sm-2 col-form-label">Weight (KG)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control product-details" id="weight" name="weight" placeholder="Enter weight" oninput="check(this)">
                    </div>
                </div>
                <br>
            </div>
        </div>
    </form>

    <script src="switcher.js"></script>
</body>

</html>