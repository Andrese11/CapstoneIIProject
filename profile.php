<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header("Location: signin.php"); // Redirect if not logged in
    exit;
}

require "PHPForms/connect.php";

$userID = $_SESSION['userID'];

$tsql = "SELECT 
            su.username,
            su.phone_number,
            su.email_address,
            al.address_line,
            al.city,
            al.region,
            al.postal_code
         FROM site_user su
         INNER JOIN user_address ua ON su.site_user_id = ua.user_address_id
         INNER JOIN address_location al ON ua.address_id = al.address_id
         WHERE su.site_user_id = ?";

$stmt = sqlsrv_query($conn, $tsql, array($userID));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$stmt = sqlsrv_query($conn, $tsql, array($userID));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cherry Clothing</title>
        <link rel="stylesheet" href="designProfile.css">
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
            <h1 class="profile">My Profile</h1>
        </header>

        <main>
            <section class="profile-section">
                <h2>Account Information</h2>
                <div class="profile-info">
                    <?php
                    while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        echo '<p><strong>Name</strong>: ' . htmlspecialchars($obj['username']) . '</p>' .
                            '<p><strong>Phone Number</strong>: ' . htmlspecialchars($obj['phone_number']) . '</p>' .
                            '<p><strong>Email</strong>: ' . htmlspecialchars($obj['email_address']) . '</p>' .
                            '<p><strong>Address</strong>: ' . htmlspecialchars($obj['address_line']) . ' ' .
                            htmlspecialchars($obj['city']) . ', ' . htmlspecialchars($obj['region']) . ' ' .
                            htmlspecialchars($obj['postal_code']) . '</p>';
                    }
                    ?>
                </div>
                <div class="buttons">
                    <a href="editProfile.php"><button class="edit-profile-button">Edit Profile</button></a>
                </div>
            </section>

            <h1 class="profile">My Orders</h1>
            <section class="orders-container">
                <?php
                $tsql = "
                        SELECT 
                            so.shop_order_id,
                            ol.product_item_id,
                            ol.price,
                            so.order_status,
                            so.shipping_address,
                            so.order_date,
                            so.order_total,
                            s.product_description,
                            s.gender_name,
                            s.color_name,
                            s.size_name
                        FROM shop_order so
                        FULL JOIN order_line ol ON so.shop_order_id = ol.order_id
                        FULL JOIN Stock s ON ol.product_item_id = s.SKU
                        WHERE so.user_id# = ?";
                $stmt = sqlsrv_query($conn, $tsql, array($userID));
                
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                $currentOrder = null; // Track the current order to avoid repeating the header

                while ($order = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    // Check if this is a new order
                    if ($currentOrder !== $order['shop_order_id']) {
                        // Close the previous order container, if any
                        if ($currentOrder !== null) {
                            echo '</div>'; // Close the items list container
                            echo '</div>'; // Close the order container
                        }

                        // Start a new order container
                        $currentOrder = $order['shop_order_id']; // Update the current order tracker
                        echo '<div class="order">';
                        echo '<h2>Order #: ' . htmlspecialchars($order['shop_order_id']) . '</h2>';
                        echo '<p><strong>Status:</strong> ' . htmlspecialchars($order['order_status']) . '</p>';
                        echo '<p><strong>Address:</strong> ' . htmlspecialchars($order['shipping_address']) . '</p>';
                        echo '<p><strong>Date:</strong> ' . htmlspecialchars($order['order_date']->format('Y-m-d H:i:s')) . '</p>';
                        echo '<h3><strong>Total:</strong> $' . htmlspecialchars($order['order_total']) . '</h3>';
                        echo '<div class="items-list">'; // Container for items
                        echo '<h4>Items:</h4>';
                    }

                    // Add the item details for this order
                    echo '<p>' . htmlspecialchars($order['product_description']) . ' (' . 
                        htmlspecialchars($order['gender_name']) . ', ' . 
                        htmlspecialchars($order['color_name']) . ', ' . 
                        htmlspecialchars($order['size_name']) . ') - $' . 
                        htmlspecialchars($order['price']) . '</p>';
                }

                // Ensure the last order container is closed
                if ($currentOrder !== null) {
                    echo '</div>'; // Close the items list container
                    echo '</div>'; // Close the order container
                }

                ?>
            </section>
        </main>

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