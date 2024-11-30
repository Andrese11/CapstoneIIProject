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

// Example of order insertion (you would need to implement order creation logic)
$orderQuery = "INSERT INTO orders (user_id, total_amount, shipping_name, shipping_address, shipping_city, shipping_state, shipping_zip, shipping_phone, payment_method)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$totalAmount = 0; // Retrieve total from the session or cart
$stmt = sqlsrv_query($conn, $orderQuery, array($userID, $totalAmount, $name, $address, $city, $state, $zip, $phone, $paymentMethod));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Logic for processing payment would go here (e.g., integrating with a payment gateway like Stripe, PayPal, etc.)

// Clear the cart after successful checkout
$sql = "DELETE FROM shopping_cart WHERE cart_id = ?";
sqlsrv_query($conn, $sql, array($cartID));

header('Location: ../thankYou.php'); // Redirect to a Thank You page
exit;
?>
