<?php 
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

    <div class="small-container">
        <div class="row row-2">
            <h2>All Products</h2>
            <select>
                <option>Default Shorting</option>
                <option>Default Shorting</option>
                <option>Default Shorting</option>
                <option>Sort by rating</option>
                <option>Sort by sale</option>
            </select>
        </div>
        <div class="row">
            <?php 
                $object = new Products;
                $products = $object->getAllProducts();
                foreach ($products as $product => $value) {
            ?>
            <div class="col-4">
                <a href="detail.php?id=<?= $value['id'] ?>"><img src="<?= $value['image'] ?>"></a>
                <h4><?= $value['description'] ?></h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p>$<?= $value['price'] ?></p>
            </div>
            <?php } ?>
        </div>
        <div class="page-btn">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>&#8594;</span>
        </div>
    </div>

    <?php include_once "./inc/footer.php" ?>
    <script src="./public/js/script.js"></script>
</body>

</html>