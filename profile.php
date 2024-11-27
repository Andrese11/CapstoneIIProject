<?php
    session_start();

    $_SESSION['userID'];
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
                    require "PHPForms/connect.php";

                    $tsql = "SELECT * from site_user
                    JOIN user_address
                    JOIN address_location
                    WHERE site_user_id = ?";

                    $stmt = sqlsrv_query($conn, $tsql, array($_SESSION["userID"]));
                    
                    if($stmt == false) {
                      echo 'Error';
                    }
                    
                    while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                      echo '<strong>Name</strong>: ' . $obj['uFirstName'] . ' ' . $obj['uLastName'] . '</br>' . 
                      '<strong>Phone Number</strong>: ' . $obj['phone_number'] . '</br>' . 
                      '<strong>Email</strong>: ' . $obj['email_address'] . '</br>' . 
                      '<strong>Address</strong>: ' . $obj['uAddress'] . ' ' . $obj['uZipCode'] . '</br>';
                    }
                ?>
            </div>
            <div class="buttons">
                <a href="editProfile.php"><button class="edit-profile-button">Edit Profile</button></a>
            </div>
        </section>

        <h1 class="profile">My Orders</h1>

        <!-- SEE HOW TO ADD THIS SECTION -->
        
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
