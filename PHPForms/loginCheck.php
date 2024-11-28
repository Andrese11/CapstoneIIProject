<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }

    if (isset($_POST['login'])) {
        $email = $_POST["email"];
        $pass = $_POST["password"];

        require_once "connect.php";

        // Prepare the SQL query
        $sql = "SELECT site_user_id, password_key FROM site_user WHERE email_address = ?";
        $stmt = sqlsrv_prepare($conn, $sql, array($email));

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (sqlsrv_execute($stmt)) {
            // Fetch the result
            $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            if ($user) {
                // Verify the password
                if ($user['password_key'] === $pass) { 
                    $_SESSION["userID"] = $user['site_user_id'];
                    echo "<script>document.location.href = '../profile.php';</script>";
                } else {
                    echo "<script> alert('Invalid password.');
                    document.location.href = '../signin.php';</script>";
                }
            } else {
                echo "<script> alert('No user found with this email.');
                document.location.href = '../signin.php';</script>";
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    } else {
        header("Location: ../signin.php");
    }

?>
