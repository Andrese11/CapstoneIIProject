<?php

session_start();

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    $userID = null; // or handle it as needed
}

if(isset($_POST['editProfile'])) {
    require_once "connect.php";

    $uName = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['postal_code'];
    $region = $_POST['region'];

} else {
    header('Location: ../profile.php');
}

?>