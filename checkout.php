<?php

$serverName = "DESKTOP-1S030LA";
$database = "CherryClothing";
$uid = "";
$pass = "";

$connection = [
"Database" => $database,
"Uid" => $uid,
"PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
die(print_r(sqlsrv_errors(),true));
?>

<?php
session_start();
include 'db_connection.php'; // Database connection file

// Fetch User Information
$user_id = $_SESSION['user_id'];
$user_query = "SELECT username, email_address, phone_number FROM site_user WHERE site_user_id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_info = $stmt->get_result()->fetch_assoc();

// Fetch Cart Items
$cart_query = "
    SELECT 
        sc.product_item_id, sc.qty, 
        p.product_name, p.price, 
        pi.sku
    FROM shopping_cart sc
    INNER JOIN product_identity pi ON sc.product_item_id = pi.product_item_id
    INNER JOIN product p ON pi.product_id = p.product_id
    WHERE sc.cart_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $_SESSION['cart_id']);
$stmt->execute();
$cart_items = $stmt->get_result();

// Fetch Shipping Address
$address_query = "
    SELECT al.address_line, al.city, al.region, al.postal_code, c.country_name 
    FROM user_address ua
    INNER JOIN address_location al ON ua.address_id = al.address_id
    INNER JOIN country c ON al.country_id = c.country_id
    WHERE ua.user_id = ? AND ua.is_default = 1";
$stmt = $conn->prepare($address_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$shipping_address = $stmt->get_result()->fetch_assoc();

// Fetch Payment Methods
$payment_query = "
    SELECT pm.payment_type_name, upm.card_number, upm.expiration_date, upm.is_default 
    FROM user_payment_method upm
    INNER JOIN payment_type pm ON upm.payment_type_id = pm.id
    WHERE upm.user_id = ? AND upm.is_default = 1";
$stmt = $conn->prepare($payment_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$payment_method = $stmt->get_result()->fetch_assoc();

// Calculate Order Total
$order_total = 0;
foreach ($cart_items as $item) {
    $order_total += $item['price'] * $item['qty'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Page</title>
</head>
<body>
    <h1>Checkout</h1>
    
    <!-- User Information -->
    <h2>User Information</h2>
    <p>Name: <?php echo htmlspecialchars($user_info['username']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user_info['email_address']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($user_info['phone_number']); ?></p>
    
    <!-- Shipping Address -->
    <h2>Shipping Address</h2>
    <p>
        <?php 
            echo htmlspecialchars($shipping_address['address_line']) . ", " . 
                 htmlspecialchars($shipping_address['city']) . ", " . 
                 htmlspecialchars($shipping_address['region']) . ", " . 
                 htmlspecialchars($shipping_address['postal_code']) . ", " . 
                 htmlspecialchars($shipping_address['country_name']); 
        ?>
    </p>
    
    <!-- Payment Method -->
    <h2>Payment Method</h2>
    <p>
        Card: <?php echo htmlspecialchars(substr($payment_method['card_number'], -4)); ?> <br>
        Expiration: <?php echo htmlspecialchars($payment_method['expiration_date']); ?>
    </p>
    
    <!-- Cart Items -->
    <h2>Order Summary</h2>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php foreach ($cart_items as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
            <td><?php echo htmlspecialchars($item['sku']); ?></td>
            <td>$<?php echo number_format($item['price'], 2); ?></td>
            <td><?php echo htmlspecialchars($item['qty']); ?></td>
            <td>$<?php echo number_format($item['price'] * $item['qty'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><strong>Order Total: $<?php echo number_format($order_total, 2); ?></strong></p>
    
    <!-- Place Order Button -->
    <form action="place_order.php" method="POST">
        <input type="hidden" name="order_total" value="<?php echo $order_total; ?>">
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
