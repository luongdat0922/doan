<?php
session_start();

include_once "./libs/connect.php";
include_once "./libs/products.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title></title>
</head>

<body>
    <?php include_once "./inc/header.php" ?>

    <div class="small-container single-product">
        <div class="row">
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die();
            $object = new Products;
            $product = $object->getProduct($id);
            $images = $object->getAllImages($id);
            ?>
            <div class="col-2">
                <img src="<?= $product['image'] ?>" width="475px" height="500px" id="product-img">

                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="<?= $product['image'] ?>" width=100% class="small-img">
                    </div>
                    <?php foreach($images as $image => $value) { ?>
                    <div class="small-img-col">
                        <img src="<?= $value['image'] ?>" width=100% class="small-img">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-2">
                <p>Home / T-Shirt</p>
                <h2 id="product-name"><?= $product['name'] ?></h2>
                <h4>$<?= $product['price'] ?></h4>
                <label for="selectSize" class="text-muted">Size</label>
                <select id="size">
                    <option selected>S</option>
                    <option value="1">M</option>
                    <option value="2">L</option>
                    <option value="3">XL</option>
                </select>
                
                <form action="cart.php?action=add" method="post">
                    <input type="text" value="" name="quantity[<?= $product['id'] ?>]">
                    <input type="submit" class="btn" style="width: 131px" value="Add Cart">
                </form>
                
            </div>
        </div>
    </div>

    <div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
            <p>View more</p>
        </div>
    </div>

    <div class="small-container">
        <div class="row">
            <div class="col-4">
                <img src="./public/images/product-1.jpg">
                <h4>Red Printed T-Shirt</h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p>$50.00</p>
            </div>
            <div class="col-4">
                <img src="./public/images/product-1.jpg">
                <h4>Red Printed T-Shirt</h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p>$50.00</p>
            </div>
            <div class="col-4">
                <img src="./public/images/product-1.jpg">
                <h4>Red Printed T-Shirt</h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p>$50.00</p>
            </div>
            <div class="col-4">
                <img src="./public/images/product-1.jpg">
                <h4>Red Printed T-Shirt</h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p>$50.00</p>
            </div>
        </div>
    </div>

    <?php include_once "./inc/footer.php" ?>
    <script src="./public/js/script.js"></script>
    <script>
        var product_img = document.getElementById("product-img");
        var small_img = document.getElementsByClassName("small-img");

        small_img[0].onclick = function() {
            product_img.src = small_img[0].src;
        }
        small_img[1].onclick = function() {
            product_img.src = small_img[1].src;
        }
        small_img[2].onclick = function() {
            product_img.src = small_img[2].src;
        }
        small_img[3].onclick = function() {
            product_img.src = small_img[3].src;
        }
    </script>
</body>

</html>