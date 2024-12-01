<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['userID']) || !isset($_SESSION['cartID'])) {
    header('Location: ../signin.php'); // Redirect to sign-in if not logged in
    exit;
}

$userID = $_SESSION['userID'];
$cartID = $_SESSION['cartID'];

// Get POST data
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$paymentMethod = $_POST['payment_method'];
$totalAmount = $_POST['total'];

/*$orderQuery = "INSERT INTO shop_order (user_id#, payment_method_id, shipping_address, order_total, order_status)
               VALUES (?, ?, ?, ?, ?, ?)";

$stmt = sqlsrv_query($conn, $orderQuery, array($userID, $paymentMethod, $address, $totalAmount, "Shipped"));*/

/*
 * $tsql = "SELECT 
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
 * 
 * 
 */
/*
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Clear the cart after successful checkout
$sql = "DELETE FROM shopping_cart WHERE cart_id = ?";
sqlsrv_query($conn, $sql, array($cartID));

header('Location: ../thankYou.php'); // Redirect to a Thank You page
exit;*/

// Step 1: Insert a new order into shop_order
$orderQuery = "
    INSERT INTO shop_order (user_id#, payment_method_id, shipping_address, order_total, order_status)
    VALUES (?, ?, ?, ?, ?)";
$params = array($userID, $paymentMethod, $address, $totalAmount, "Shipped");

$stmt = sqlsrv_query($conn, $orderQuery, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Step 2: Get the generated shop_order_id for the new order
$orderIDQuery = "SELECT TOP 1 shop_order_id 
                 FROM shop_order
                 ORDER BY order_date DESC;";
$orderIDStmt = sqlsrv_query($conn, $orderIDQuery);

if ($orderIDStmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$orderID = sqlsrv_fetch_array($orderIDStmt, SQLSRV_FETCH_ASSOC)['shop_order_id'];

if (!$orderID) {
    die("Failed to retrieve the shop_order_id.");
}

// Step 3: Retrieve items from the shopping cart
$cartQuery = "
    SELECT 
        sc.product_item_id, 
        p.price 
    FROM shopping_cart sc
    INNER JOIN Stock s ON sc.product_item_id = s.SKU
    INNER JOIN product p ON s.product_description = p.product_description
    AND CAST(SUBSTRING(s.SKU, 1, CHARINDEX('-', s.SKU) - 1) AS INT) = p.product_id;";
$cartStmt = sqlsrv_query($conn, $cartQuery, array($cartID));

if ($cartStmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Step 4: Insert items into order_line
$orderLineQuery = "
    INSERT INTO order_line (product_item_id, order_id, price) 
    VALUES (?, ?, ?)";

while ($row = sqlsrv_fetch_array($cartStmt, SQLSRV_FETCH_ASSOC)) {
    $productItemID = $row['product_item_id'];
    $price = $row['price'];

    $orderLineStmt = sqlsrv_query($conn, $orderLineQuery, array($productItemID, $orderID, $price));

    if ($orderLineStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Step 5: Clear the cart after successful checkout
$clearCartQuery = "DELETE FROM shopping_cart WHERE cart_id = ?";
sqlsrv_query($conn, $clearCartQuery, array($cartID));

// Redirect to a Thank You page
header('Location: ../thankYou.php');
exit;
?>
