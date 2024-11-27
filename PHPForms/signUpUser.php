<?php
    session_start();

    $_SESSION['userID'];

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