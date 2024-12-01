<?php
session_start();
require_once 'PHPForms/connect.php';

if (!isset($_SESSION['userID']) || !isset($_SESSION['cartID'])) {
    header('Location: signin.php'); // Redirect to sign-in page if not logged in
    exit;
}

$userID = $_SESSION['userID'];
$cartID = $_SESSION['cartID'];

// Get the cart items for the user
$tsql = "SELECT 
                sc.cart_id AS cart_id,
                sc.product_item_id AS product_item_id,
                sc.qty AS qty,
                s.SKU AS SKU,
                s.product_description AS product_description,
                s.gender_name AS gender_name,
                s.color_name AS color_name,
                s.size_name AS size_name,
                p.price AS price,
                p.product_name AS product_name,
                p.product_id AS product_id,
                pimg.image_filename AS image_filename
         FROM shopping_cart sc
         INNER JOIN Stock s ON sc.product_item_id = s.SKU
         INNER JOIN product p ON s.product_description = p.product_description
         LEFT JOIN product_image pimg ON p.product_id = pimg.product_item_id
         WHERE sc.cart_id = ? AND CAST(SUBSTRING(s.SKU, 1, CHARINDEX('-', s.SKU) - 1) AS INT) = p.product_id;";

$stmt = sqlsrv_query($conn, $tsql, array($cartID));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$total = 0;
$cartItems = [];
while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $cartItems[] = $obj;
    $total += $obj['price'] * $obj['qty'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherry Clothing</title>
    <link rel="stylesheet" href="designCart.css">
</head>
<body>
    <nav>
        <a href="main.php" class="logo"><img src="NO_BACKGROUND.png" alt="Company Logo"></a>
        <ul class="nav-list">
            <li><a href="main.php">Home</a></li>
            <li><a href="catalog.php">Products</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="signin.php">My Profile</a></li>
        </ul>
    </nav>
    
    <header>
        <h1>Checkout</h1>
    </header>

    <section class="cart-items">
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item">
                <img src="Designs/<?= htmlspecialchars($item['image_filename'] . '.jpg') ?>" alt="Product Image">
                <h3><?= htmlspecialchars($item['product_name']) ?></h3>
                <p>Price: $<?= htmlspecialchars(number_format($item['price'], 2)) ?></p>
                <p>Quantity: <?= htmlspecialchars($item['qty']) ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <section class="checkout-form">
        <h2>Shipping Information</h2>
        <form action="PHPForms/processCheckout.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <label for="city">City</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State</label>
            <input type="text" id="state" name="state" required>

            <label for="zip">Zip Code</label>
            <input type="text" id="zip" name="zip" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" required>

            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" required>
                <option value="1">Credit Card</option>
                <option value="2">PayPal</option>
            </select>

            <input type="hidden" name="total" value="<?= htmlspecialchars(number_format($total, 2)) ?>">

            <p>Total: $<?= htmlspecialchars(number_format($total, 2)) ?></p>

            <button type="submit" class="checkout-btn">Complete Order</button>
        </form>
    </section>

    <footer class="footer">
        <div class ="footLeft">
            <img src = "NO_BACKGROUND.png"/>
            <p>Cherry Clothing is a website made for a senior project with no intention for commercial use.</p>
        </div>
        <div class ="footRight">
            <ul>
                <li><h2><u>Directory</u></h2></li>
                <li><a href="main.php">Home</a></li>
                <li><a href="catalog.php">Products</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="signin.php">My Profile</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
