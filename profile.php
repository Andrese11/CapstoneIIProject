<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header("Location: signin.php"); // Redirect if not logged in
    exit;
}

require "PHPForms/connect.php";

$userID = $_SESSION['userID'];

$tsql = "SELECT 
            su.username,
            su.phone_number,
            su.email_address,
            al.address_line,
            al.city,
            al.region,
            al.postal_code
         FROM site_user su
         INNER JOIN user_address ua ON su.site_user_id = ua.user_address_id
         INNER JOIN address_location al ON ua.address_id = al.address_id
         WHERE su.site_user_id = ?";

$stmt = sqlsrv_query($conn, $tsql, array($userID));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$stmt = sqlsrv_query($conn, $tsql, array($userID));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cherry Clothing</title>
        <link rel="stylesheet" href="designProfile.css">
    </head>
    <body>
        <nav>
            <a href="main.php" class="logo"><img src="NO_BACKGROUND.png" alt="Company Logo"></a>
            <ul class="nav-list">
                <li><a href="main.php">Home</a></li>
                <li><a href="catalog.php">Products</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="signin.php">My Profile</a></li>
            </ul>
        </nav>

        <header>
            <h1 class="profile">My Profile</h1>
        </header>

        <section class="profile-section">
        <h2>Account Information</h2>
        <div class="profile-info">
            <?php
            while ($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo '<p><strong>Name</strong>: ' . htmlspecialchars($obj['username']) . '</p>' .
                     '<p><strong>Phone Number</strong>: ' . htmlspecialchars($obj['phone_number']) . '</p>' .
                     '<p><strong>Email</strong>: ' . htmlspecialchars($obj['email_address']) . '</p>' .
                     '<p><strong>Address</strong>: ' . htmlspecialchars($obj['address_line']) . ' ' .
                     htmlspecialchars($obj['city']) . ', ' . htmlspecialchars($obj['region']) . ' ' .
                     htmlspecialchars($obj['postal_code']) . '</p>';
            }
            ?>
        </div>
        <div class="buttons">
            <a href="editProfile.php"><button class="edit-profile-button">Edit Profile</button></a>
        </div>
    </section>

    <h1 class="profile">My Orders</h1>

    <footer class="footer">
        <div class ="footLeft">
            <img src = "NO_BACKGROUND.png"/>
            <p>Cherry Clothing is a website made for a senior project with no intention for commercial use.</p>
        </div>
        <div class ="footRight">
            <ul>
                <li><h2><u>Directory</u></h2></li>
                <li><a href="main.php">Home</a></li>
                <li><a href="catalog.php">Products</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="signin.php">My Profile</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>