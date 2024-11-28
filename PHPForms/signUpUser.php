<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }

    require_once "connect.php";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    if(isset($_POST['signUp'])) {

    } else {
        header("Location: ..\signup.php");
    }
?>