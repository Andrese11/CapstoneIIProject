<?php
    session_start();

    require_once 'PHPForms/connect.php';


    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }

    if (isset($_SESSION['cartID'])) {
        $cartID = $_SESSION['cartID'];
    } else {
        $cartID = 0;
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
            <h1 class="cart">Shopping Cart</h1>
        </header>
        <section class="cart-items">
            <?php
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

                $stmt = sqlsrv_query($conn, $tsql, array($userID));

                if ($stmt === false) {
                    error_log("SQL Query Failed: " . print_r(sqlsrv_errors(), true));
                    die("An error occurred while fetching the cart items.");
                }
                
                $total = 0;

                $isCartEmpty = false;

                if (sqlsrv_has_rows($stmt) === false) {
                    echo '<p>Your cart is empty.</p>';
                    $isCartEmpty = true;
                }                

                while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $productDescription = $obj['product_description'] ?? 'No description available';
                    $descriptionParts = explode(':', $productDescription);
                    $productName = trim($descriptionParts[0]);
                    $price = $obj['price'] ?? 0; // Fallback to 0 if price is missing.
                    $quantity = $obj['qty'] ?? 1; // Fallback to 1 if quantity is missing.
                
                    echo '<div class="cart-item">';
                    echo '<img src="Designs/' . htmlspecialchars($obj['image_filename'] ?? 'Images/Product1.jpg') . '.jpg" alt="Product Image">';
                    echo '<h2>' . htmlspecialchars($productName) . '</h2>';
                    echo '<p>Price: $' . htmlspecialchars(number_format($obj['price'] ?? 0, 2)) . '</p>';
                    echo '<label>Quantity:</label> <input type="number" value="' . htmlspecialchars($obj['qty'] ?? 1) . '">';
                    echo '<form action="PHPForms/removeFromCart.php" method="POST">
                              <input type="hidden" name="product_item_id" value="' . htmlspecialchars($obj['product_item_id']) . '">
                              <button type="submit">Remove</button>
                          </form>';
                    echo '</div>';

                    $total += $price * $quantity;
                }

                if(!$isCartEmpty) {
                echo "<div class=\"cart-footer\">
                        <p class=\"total\" id=\"total\">Total: $total</p>
                        <a href=\"checkout.php\"><button class=\"checkout\" id=\"checkout\">Checkout</button></a>
                    </div>";
                }
            ?>
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
