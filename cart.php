<?php
include_once "./libs/connect.php";
include_once "./libs/products.php";
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_GET['action'])) {
    function update_cart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                if ($add) {
                    $_SESSION["cart"][$id] += $quantity;
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
    }

    switch ($_GET['action']) {
        case "add":
            update_cart(true);
            header('Location: ./cart.php');
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION['cart'][$_GET['id']]);
            }
            header('Location: ./cart.php');
            break;
        case 'update':
            update_cart();
            header('Location: ./cart.php');
            break;
        case 'order':
            $save = new Products;
            $groupID = implode(',', array_keys($_SESSION['cart']));
            $products = $save->searchProducts($groupID);
            $total = 0;
            foreach ($products as $product) {
                $price = $product['price'] * $_SESSION['cart'][$product['id']];
                $total += $price;
            }
            $users_id = 1;
            $orderID = $save->createOrder($users_id, $total);;
            $insertString = "";
            foreach ($products as $product => $value) {
                $insertString .= "(NULL, '" . $orderID . "', '" . $value['id'] . "', '" .  $_SESSION['cart'][$value['id']] . "', '" . $value['price'] * $_SESSION['cart'][$value['id']] . "')";
                if ($product != count($products) - 1) {
                    $insertString .= ",";
                }
            }
            $save->createDetail($insertString);
            break;
    }
}
if (!empty($_SESSION['cart'])) {
    $groupID = implode(',', array_keys($_SESSION['cart']));
    $object = new Products;
    $products = $object->searchProducts($groupID);
}
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


    <div class="small-container cart-page">
        <form action="cart.php?action=update" method="post">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php
                $total = 0;
                if (!empty($products)) {
                    foreach ($products as $product) {
                ?>
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <img src="<?= $product['image'] ?>">
                                    <div>
                                        <p></p>
                                        <small>Price: $<?= $product['price'] ?></small>
                                        <br />
                                        <a href="cart.php?action=delete&id=<?= $product['id'] ?>">Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td><input size=2 type="text" value="<?= $_SESSION['cart'][$product['id']] ?>" name="quantity[<?= $product['id'] ?>]"></td>
                            <td>$<?= $product['price'] * $_SESSION['cart'][$product['id']] ?></td>
                        </tr>
                <?php
                        $total += $product['price'] * $_SESSION['cart'][$product['id']];
                    }
                } ?>
            </table>
            <input type="submit" class="btn" style="width: 131px" value="Update">
        </form>

        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$<?= $total ?></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$<?= $ship = 35; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$<?= $total + $ship ?></td>
                </tr>
            </table>
        </div>
        <a href="cart.php?action=order" class="btn">Order</a>
    </div>



    <?php include_once "./inc/footer.php" ?>
    <script src="./public/js/script.js"></script>
</body>

</html>