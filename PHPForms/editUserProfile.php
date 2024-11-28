<?php

session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: ../signin.php'); // Redirect to sign-in if not logged in
    exit;
}

if (isset($_POST['editProfile'])) {
    require_once "connect.php";

    // Sanitize user inputs
    $uName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['postal_code'];
    $state = $_POST['region'];
    $pass = $_POST['password'];

    $userID = $_SESSION['userID'];

    // Update `site_user`
    $updateUserSql = "UPDATE site_user
                      SET username = ?, email_address = ?, phone_number = ?, password_key = ?
                      WHERE site_user_id = ?";

    $updateUserStmt = sqlsrv_prepare($conn, $updateUserSql, [$uName, $email, $phone, $pass, $userID]);

    if ($updateUserStmt && sqlsrv_execute($updateUserStmt)) {
        // Fetch the address_id linked to this user
        $getAddressIdSql = "SELECT address_id FROM user_address WHERE user_address_id = ?";
        $getAddressIdStmt = sqlsrv_query($conn, $getAddressIdSql, [$userID]);
        
        if ($getAddressIdStmt && ($row = sqlsrv_fetch_array($getAddressIdStmt, SQLSRV_FETCH_ASSOC))) {
            $addressID = $row['address_id'];

            // Update `address_location`
            $updateAddressSql = "UPDATE address_location
                                 SET address_line = ?, city = ?, region = ?, postal_code = ?
                                 WHERE address_id = ?";
            $updateAddressStmt = sqlsrv_prepare($conn, $updateAddressSql, [$address, $city, $state, $zip, $addressID]);

            if ($updateAddressStmt && sqlsrv_execute($updateAddressStmt)) {
                echo "<script>alert('Profile updated successfully!');</script>";
                header('Location: ../profile.php');
                exit;
            } else {
                die(print_r(sqlsrv_errors(), true));
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    } else {
        die(print_r(sqlsrv_errors(), true));
    }
} else {
    header('Location: ../profile.php');
    exit;
}
?>
