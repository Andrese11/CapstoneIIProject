<?php

session_start();

require_once 'connect.php';

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

$removeItem = $_POST['product_item_id'];

$tsql = "DELETE FROM shopping_cart WHERE product_item_id = ?";

$stmt = sqlsrv_prepare($conn, $tsql, array($removeItem));

if (sqlsrv_execute($stmt)) {
    echo "<script> alert('Item successfully removed from the cart.');
    document.location.href = '../cart.php';</script>";
} else {
    die(print_r(sqlsrv_errors(), true));
}

?>