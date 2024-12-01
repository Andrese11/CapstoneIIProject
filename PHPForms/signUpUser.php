<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }

    if(isset($_POST['signUp'])) {
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
/*
    // Update `site_user`
    $createUserSql = "INSERT INTO site_user (username, email_address, phone_number, password_key)
                      VALUES (?,?,?,?);";

    $createUserStmt = sqlsrv_prepare($conn, $createUserSql, [$uName, $email, $phone, $pass]);

    if ($createUserStmt && sqlsrv_execute($createUserStmt)) {

        $userIDQuery = "SELECT TOP 1 site_user_id
                         FROM site_user
                         ORDER BY site_user_id DESC";
        $userIDStmt = sqlsrv_query($conn, $userIDQuery);

        if ($userIDStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $userID = sqlsrv_fetch_array($userIDStmt, SQLSRV_FETCH_ASSOC)['site_user_id'];
        // Fetch the address_id linked to this user
        $addAddressIdSql = "INSERT INTO user_address (address_id, is_default)
                            VALUES (?,?)";
        $addAddressIdStmt = sqlsrv_query($conn, $addAddressIdSql, [$userID, 1]);
        
        if ($addAddressIdStmt && ($row = sqlsrv_fetch_array($addAddressIdStmt, SQLSRV_FETCH_ASSOC))) {
            $addressID = $row['address_id'];
             echo $addressID;
            // Update `address_location`
            $addAddressSql = "INSERT INTO address_location (address_line, city, region, postal_code, country_id)
                                 VALUES (?,?,?,?,?);";
            $addAddressStmt = sqlsrv_prepare($conn, $addAddressSql, [$address, $city, $state, $zip, 1]);

            if ($addAddressStmt && sqlsrv_execute($addAddressStmt)) {
                echo "<script>alert('Profile created successfully!');</script>";
                //header('Location: ../signIn.php');
                //exit;
            } else {
                die(print_r(sqlsrv_errors(), true));
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    } else {
        die(print_r(sqlsrv_errors(), true));
    }*/
    $createUserSql = "INSERT INTO site_user (username, email_address, phone_number, password_key)
                  VALUES (?, ?, ?, ?)";
$createUserStmt = sqlsrv_prepare($conn, $createUserSql, [$uName, $email, $phone, $pass]);

if ($createUserStmt && sqlsrv_execute($createUserStmt)) {
    // Step 2: Fetch the new user's ID using SCOPE_IDENTITY()
    $userIDQuery = "SELECT TOP 1 site_user_id
                    FROM site_user
                    ORDER BY site_user_id DESC";
    $userIDStmt = sqlsrv_query($conn, $userIDQuery);

    if ($userIDStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $userID = sqlsrv_fetch_array($userIDStmt, SQLSRV_FETCH_ASSOC)['site_user_id'];

    if (!$userID) {
        die("Failed to retrieve the new user ID.");
    }

    // Step 3: Insert into `user_address`
    $addAddressIdSql = "INSERT INTO user_address (address_id, is_default)
                        VALUES (?, ?)";
    $addAddressIdStmt = sqlsrv_prepare($conn, $addAddressIdSql, [$userID, 1]);

    if ($addAddressIdStmt && sqlsrv_execute($addAddressIdStmt)) {
        // Step 4: Insert into `address_location`
        $addAddressSql = "INSERT INTO address_location (address_line, city, region, postal_code, country_id)
                          VALUES (?, ?, ?, ?, ?)";
        $addAddressStmt = sqlsrv_prepare($conn, $addAddressSql, [$address, $city, $state, $zip, 1]);

        if ($addAddressStmt && sqlsrv_execute($addAddressStmt)) {
            echo "<script>alert('Profile created successfully!');</script>";
            // Redirect to sign-in page
             header('Location: ../signin.php');
             exit;
        } else {
            die("Error inserting into address_location: " . print_r(sqlsrv_errors(), true));
        }
    } else {
        die("Error inserting into user_address: " . print_r(sqlsrv_errors(), true));
    }
} else {
    die("Error creating user: " . print_r(sqlsrv_errors(), true));
}
    } else {
        header("Location: ../signup.php");
    }
?>