<?php 

session_start();

require_once '../PHPForms/connect.php';

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    $_SESSION['cartID'] = $_SESSION['userID'];
} else {
    $userID = null; // or handle it as needed
}

if (isset($_SESSION['cartID'])) {
    $cartID = $_SESSION['cartID'];
} else {
    $_SESSION['cartID'] = 0;
}

$size = $_POST['size'];
$color = $_POST['color'];
$qty = $_POST['qty'];
$product_code = $_POST['product_code'];

$product_code = "$product_code-$color-$size";

$tsql = "INSERT INTO shopping_cart (cart_id, product_item_id, qty) 
         VALUES (?, ?, ?);";

$stmt = sqlsrv_prepare($conn, $tsql, array($_SESSION['cartID'], $product_code, $qty));
if (sqlsrv_execute($stmt)) {
    echo "<script> alert('Item successfully Added to the cart.');
    document.location.href = '../catalog.php';</script>";
} else {
    die(print_r(sqlsrv_errors(), true));
}
?>